<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testContactPage(): void
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/single');

        $this->assertResponseIsSuccessful();
    }
}
