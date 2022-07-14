<?php

namespace App\Tests\Controller\Home;

use App\Controller\Home\HomeController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomeControllerValidResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());
    }
}
