<?php

declare(strict_types=1);


namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSetAndGetPhone()
    {
        $phone = '123123123';
        $user = new User();
        $user->setPhone($phone);
        $this->assertIsString($user->getPhone());
        $this->assertEquals($phone, $user->getPhone());
    }

    public function testGetUserIdentifier()
    {
        $email = "test@test.com";
        $user = new User();
        $user->setEmail($email);
        $this->assertEquals($email, $user->getUserIdentifier());
    }
}