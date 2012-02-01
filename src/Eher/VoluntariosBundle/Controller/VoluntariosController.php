<?php

namespace Eher\VoluntariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Eher\VoluntariosBundle\Entity\Place,
    chegamos\rest\Guzzle as RestClient,
    chegamos\entity\repository\UserRepository,
    chegamos\entity\repository\PlaceRepository;

class VoluntariosController extends Controller
{
    private $navUrl = array();

    public function generateNavUrl()
    {
        $this->navUrl['homepage'] = $this->get('router')->generate("homepage");
        $this->navUrl['sobre'] = $this->get('router')->generate("sobre");
        $this->navUrl['buscar'] = $this->get('router')->generate("buscar");
        $this->navUrl['cadastrarVoluntario'] = $this->get('router')->generate("cadastrarVoluntario");
        $this->navUrl['cadastrarEntidade'] = $this->get('router')->generate("cadastrarEntidade");
        $this->navUrl['contato'] = $this->get('router')->generate("contato");
    }

    public function indexAction()
    {
        $this->generateNavUrl();

        $restClient = new RestClient("http://api.apontador.com.br/v1/");
        $restClient->setAuth(
            $this->container->getParameter('apontador_consumer_key'),
            $this->container->getParameter('apontador_consumer_secret')
        );

        $userRepository = new UserRepository($restClient);
        $user = $userRepository->get("8972911185");

        $placeRepository = new PlaceRepository($restClient);
        $place = $placeRepository->get("UCV34B2P");

        return $this->render(
            'EherVoluntariosBundle:Voluntarios:index.html.twig',
            array(
                'navUrl' => $this->navUrl,
                'user' => $user,
                'place' => $place,
            )
        );
    }

    public function sobreAction()
    {
        $this->generateNavUrl();
        return $this->render(
            'EherVoluntariosBundle:Voluntarios:sobre.html.twig',
            array('navUrl' => $this->navUrl)
        );
    }

    public function buscarAction()
    {
        $this->generateNavUrl();
        return $this->render(
            'EherVoluntariosBundle:Voluntarios:buscar.html.twig',
            array('navUrl' => $this->navUrl)
        );
    }

    public function cadastrarVoluntarioAction()
    {
        $this->generateNavUrl();
        return $this->render(
            'EherVoluntariosBundle:Voluntarios:cadastrarVoluntario.html.twig',
            array('navUrl' => $this->navUrl)
        );
    }

    public function cadastrarEntidadeAction()
    {
        $this->generateNavUrl();
        return $this->render(
            'EherVoluntariosBundle:Voluntarios:cadastrarEntidade.html.twig',
            array('navUrl' => $this->navUrl)
        );
    }

    public function contatoAction()
    {
        $this->generateNavUrl();
        return $this->render(
            'EherVoluntariosBundle:Voluntarios:contato.html.twig',
            array('navUrl' => $this->navUrl)
        );
    }
}
