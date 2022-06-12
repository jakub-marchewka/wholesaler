<?php

namespace App\Service\Admin\File;

use App\Entity\AdminFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Uuid;

class AdminFileDeleteService
{
    public function __construct(private EntityManagerInterface $entityManager, private Filesystem $filesystem)
    {
    }

    public function delete(string $adminFileId, string $directory): bool
    {
        $adminFile = $this->entityManager->getRepository(AdminFile::class)->findOneBy(['id' => $adminFileId]);
        if (!empty($adminFile)) {
            if ($this->filesystem->exists($directory."/".$adminFile->getFileName())) {
                $this->filesystem->remove($directory."/".$adminFile->getFileName());
                $this->entityManager->remove($adminFile);
                $this->entityManager->flush();
                return true;
            }
        }
        return false;
    }
}
