<?php

namespace Eher\QueroSerVoluntario\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EherQueroSerVoluntarioApiBundle:Default:index.html.twig', array('name' => $name));
    }
}
