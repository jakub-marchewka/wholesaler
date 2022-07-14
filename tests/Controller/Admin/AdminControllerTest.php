<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\User;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testResponseForUnauthorizedUser()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('noadmin@test.com');
        $client->loginUser($testUser);

        $client->request('GET', '/admin');

        $this->assertResponseStatusCodeSame(403, $client->getResponse()->getStatusCode());
    }

    public function testResponseForAuthorizedUser()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@test.com');
        $client->loginUser($testUser);
        $client->request('GET', '/admin');

        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
    }
}
