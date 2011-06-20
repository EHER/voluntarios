<?php

namespace Eher\VoluntariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Doctrine\REST\Client\Client,
    Doctrine\REST\Client\Manager,
    Doctrine\REST\Client\Entity,
    Eher\VoluntariosBundle\Entity\Place;

class VoluntariosController extends Controller
{

    public function indexAction()
    {
        return $this->render('EherVoluntariosBundle:Voluntarios:index.html.twig');
    }

    public function welcomeAction()
    {
        $client = new Client();

        $manager = new Manager($client);
        $manager->registerEntity('Eher\VoluntariosBundle\Entity\Place');

        Entity::setManager($manager);

        $place = Place::find('C406355363443Q443C'); 
        var_dump($place);

        return $this->render('EherVoluntariosBundle:Voluntarios:welcome.html.twig');
    }

}
