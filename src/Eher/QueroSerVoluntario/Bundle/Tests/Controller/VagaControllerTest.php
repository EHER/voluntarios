<?php

namespace Eher\QueroSerVoluntario\Bundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VagaControllerTest extends WebTestCase
{
    public function testIndexOfVagas()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/vagas');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();
    }
}
