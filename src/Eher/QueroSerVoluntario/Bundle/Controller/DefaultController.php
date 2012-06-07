<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    chegamos\entity\Place,
    chegamos\entity\City,
    chegamos\entity\Address,
    chegamos\rest\Guzzle as RestClient,
    chegamos\entity\repository\UserRepository,
    chegamos\entity\repository\PlaceRepository;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EherQueroSerVoluntarioBundle:Default:index.html.twig');
    }

    public function sobreAction()
    {
        return $this->render('EherQueroSerVoluntarioBundle:Default:sobre.html.twig');
    }

    public function buscarAction()
    {
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
            'EherQueroSerVoluntarioBundle:Default:buscar.html.twig',
            array(
                'cityName' => $cityName,
                'stateName' => $stateName,
                'search' => $search,
            )
        );
    }

    public function cadastrarVoluntarioAction()
    {
        return $this->render('EherQueroSerVoluntarioBundle:Default:cadastrarVoluntario.html.twig');
    }

    public function cadastrarEntidadeAction()
    {
        return $this->render('EherQueroSerVoluntarioBundle:Default:cadastrarEntidade.html.twig');
    }

    public function contatoAction()
    {
        return $this->render('EherQueroSerVoluntarioBundle:Default:contato.html.twig');
    }
}
