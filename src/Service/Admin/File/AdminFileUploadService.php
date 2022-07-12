<?php

declare(strict_types=1);

namespace App\Service\Admin\File;

use App\Entity\AdminFile;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminFileUploadService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SluggerInterface $slugger
    ) {
    }

    /**
     * @param $form
     * @param string $pathToUploadDirectory
     * @param AdminFile $adminFile
     * @param User $user
     * @return bool
     */
    public function upload($form, string $pathToUploadDirectory, AdminFile $adminFile, User $user): bool
    {
        $file = $form->get('fileName')->getData();
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        try {
            $file->move(
                $pathToUploadDirectory,
                $newFilename
            );
            $adminFile->setFileName($newFilename);
            $adminFile->setCreatedAt(new \DateTimeImmutable());
            $adminFile->setUser($user);
            $this->entityManager->persist($adminFile);
            $this->entityManager->flush();
        } catch (FileException $e) {
            return false;
        }
        return true;
    }
}
