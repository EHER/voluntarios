<?php

namespace Eher\QueroSerVoluntario\Bundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CidadeControllerTest extends WebTestCase
{
    public function testIndexOfCidade()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cidades/em/sp');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Cidades em SP",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testLinkToSorocaba()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cidades/em/sp');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->click($crawler->selectLink('Sorocaba')->link());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Entidades em Sorocaba - SP",
            $crawler->filter('body > div > h2')->text()
        );
    }

}
