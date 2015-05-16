<?php

namespace Eher\QueroSerVoluntario\Bundle\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MensagemControllerTest extends WebTestCase
{
    public function testWelcome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/bem-vindo');
    }

    public function testRecomendation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/recomendacao');
    }

    public function testNews()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/novidades');
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

}
