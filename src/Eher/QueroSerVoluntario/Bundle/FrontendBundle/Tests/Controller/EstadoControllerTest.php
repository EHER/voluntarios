<?php
namespace Eher\QueroSerVoluntario\Bundle\FrontendBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EstadoControllerTest extends WebTestCase
{
    public function testIndexOfEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/brasil');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Estados do Brasil",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testLinkToSp()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/brasil');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->click($crawler->selectLink('SP')->link());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Cidades em SP",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testLinkToRj()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/brasil');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->click($crawler->selectLink('RJ')->link());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Cidades em RJ",
            $crawler->filter('body > div > h2')->text()
        );
    }
}
