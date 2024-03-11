<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testSingleTrick(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/trick/single/test');

        $this->assertResponseIsSuccessful();
    }

    public function testLogin(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
    }

    public function testRegistration(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/inscription');

        $this->assertResponseIsSuccessful();
    }

    public function testResetPassword(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/reset-password');

        $this->assertResponseIsSuccessful();
    }
}
