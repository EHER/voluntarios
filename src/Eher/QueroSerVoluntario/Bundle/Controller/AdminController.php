<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function homeAction()
    {
        return $this->render('EherQueroSerVoluntarioBundle:Admin:home.html.twig');
    }
}
