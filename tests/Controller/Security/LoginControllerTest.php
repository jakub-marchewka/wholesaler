<?php

namespace App\Tests\Controller\Security;

use App\Controller\Security\LoginController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testValidCredentialsLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $buttonCrawlerNode = $crawler->selectButton('submit');
        $form = $crawler->selectButton('Login')->form();
        $extract = $crawler->filter('input[name="_csrf_token"]')
            ->extract(array('value'));
        $csrf_token = $extract[0];
        $form['_username'] = 'noadmin@test.com';
        $form['_password'] = 'Tester123';
        $form['_csrf_token'] = $csrf_token;
        $client->submit($form);
        $this->assertResponseRedirects('http://localhost/');
    }

    public function testInvalidCredentialsLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $buttonCrawlerNode = $crawler->selectButton('submit');
        $form = $crawler->selectButton('Login')->form();
        $extract = $crawler->filter('input[name="_csrf_token"]')
            ->extract(array('value'));
        $csrf_token = $extract[0];
        $form['_username'] = 'noadmin@test.com';
        $form['_password'] = 'Tester1234';
        $form['_csrf_token'] = $csrf_token;
        $client->submit($form);
        $this->assertResponseRedirects('http://localhost/login');
    }
}
