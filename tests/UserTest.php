<?php

declare(strict_types=1);


namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetPhone()
    {
        $phone = '123123123';
        $user = new User();
        $user->setPhone($phone);
        $this->assertIsString($user->getPhone());
        $this->assertEquals($phone, $user->getPhone());
    }
}