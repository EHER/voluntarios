<?php
namespace Eher\QueroSerVoluntario\Bundle\FrontendBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Quero ser voluntário!",
            $crawler->filter('body > div > div > h1')->text()
        );
    }

    public function testAboutPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sobre');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Sobre o Site",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testSearchPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/entidades');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Busca de Entidades",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testVoluntarioSubscribePage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/voluntarios/cadastrar');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Cadastro de Voluntário",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testEntidadeSubscribePage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/entidades/cadastrar');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Cadastro de Entidade",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testContactPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contato');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Contato",
            $crawler->filter('body > div > h2')->text()
        );
    }

    public function testAboutMenuLink()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $crawler = $client->click($crawler->selectLink('Sobre o Site')->link());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            "Sobre o Site",
            $crawler->filter('body > div > h2')->text()
        );
    }
}
