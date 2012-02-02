<?php

namespace Eher\VoluntariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    chegamos\entity\Place,
    chegamos\entity\City,
    chegamos\entity\Address,
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

        return $this->render(
            'EherVoluntariosBundle:Voluntarios:index.html.twig',
            array(
                'navUrl' => $this->navUrl,
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
        $search = null;
        $cityName = $this->getRequest()->query->get('cidade');
        $stateName = $this->getRequest()->query->get('uf');

        if (!empty($cityName) && !empty($stateName)) {
            $restClient = new RestClient("http://api.apontador.com.br/v1/");
            $restClient->setAuth(
                $this->container->getParameter('apontador_consumer_key'),
                $this->container->getParameter('apontador_consumer_secret')
            );
            $placeRepository = new PlaceRepository($restClient);

            $city = new City();
            $city->setName($cityName);
            $city->setState($stateName);

            $address = new Address();
            $address->setCity($city);

            $search = $placeRepository->byAddress($address)
                ->withSubcategoryId("6661")
                ->getAll();
        }

        return $this->render(
            'EherVoluntariosBundle:Voluntarios:buscar.html.twig',
            array(
                'navUrl' => $this->navUrl,
                'cityName' => $cityName,
                'stateName' => $stateName,
                'search' => $search,
            )
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
            array(
                'navUrl' => $this->navUrl,
            )
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
