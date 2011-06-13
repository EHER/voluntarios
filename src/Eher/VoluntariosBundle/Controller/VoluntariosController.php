<?php

namespace Eher\VoluntariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VoluntariosController extends Controller
{
    public function indexAction()
    {
        return $this->render('EherVoluntariosBundle:Voluntarios:index.html.twig');
    }
    
    public function welcomeAction()
    {
        return $this->render('EherVoluntariosBundle:Voluntarios:welcome.html.twig');
    }
}
