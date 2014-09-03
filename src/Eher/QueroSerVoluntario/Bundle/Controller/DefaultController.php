<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Entidade;
use Eher\QueroSerVoluntario\Bundle\Entity\Voluntario;
use Eher\QueroSerVoluntario\Bundle\Form\EntidadeType;
use Eher\QueroSerVoluntario\Bundle\Form\VoluntarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use chegamos\entity\Address;
use chegamos\entity\City;
use chegamos\entity\Config;
use chegamos\entity\Place;
use chegamos\entity\repository\PlaceRepository;
use chegamos\entity\repository\UserRepository;
use chegamos\rest\auth\BasicAuth;
use chegamos\rest\client\Guzzle as RestClient;

class DefaultController extends Controller
{
    public function buscarEntidadeAction()
    {
        $search = null;
        $cityName = $this->getRequest()->query->get('cidade');
        $stateName = $this->getRequest()->query->get('estado');

        if (!empty($cityName) && !empty($stateName)) {
            $city = new City();
            $city->setName($cityName);
            $city->setState($stateName);

            $address = new Address();
            $address->setCity($city);

            $search = $this->get('place_repository')
                ->byAddress($address)
                ->byListId(25)
                ->getAll();
        }

        return $this->render(
            'EherQueroSerVoluntarioBundle:Default:buscarEntidade.html.twig',
            [
                'cityName' => $cityName,
                'stateName' => $stateName,
                'search' => $search,
            ]
        );
    }

    public function entidadesByCityAndStateAction($cityName, $stateName)
    {
        $search = null;
        $cityName = str_replace('-', ' ', $cityName);

        if (!empty($cityName) && !empty($stateName)) {
            $city = new City();
            $city->setName($cityName);
            $city->setState($stateName);

            $address = new Address();
            $address->setCity($city);

            $search = $this->get('place_repository')
                ->byAddress($address)
                ->byListId(25)
                ->getAll();
        }

        return $this->render(
            'EherQueroSerVoluntarioBundle:Default:entidades.html.twig',
            array(
                'cityName' => $cityName,
                'stateName' => $stateName,
                'search' => $search,
            )
        );
    }

    public function newVoluntarioFormAction()
    {
        $entity = new Voluntario();
        $form   = $this->createForm(
            new VoluntarioType(),
            $entity,
            ['action' => $this->generateUrl('voluntario_criar')]
        );

        return $this->render('EherQueroSerVoluntarioBundle:Default:newVoluntarioForm.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createVoluntarioAction()
    {
        $entity = new Voluntario();
        $request = $this->getRequest();
        $form = $this->createForm(new VoluntarioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();

            $this->get("mail_manager")
                ->setContactEmail(
                    $this->container->getParameter("contact_email")
                )
                ->generateMessageWithVoluntario($entity)
                ->send();

            return $this->redirect(
                $this->generateUrl('voluntario_parabens')
            );
        }

        return $this->render('EherQueroSerVoluntarioBundle:Voluntario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function newEntidadeFormAction()
    {
        $entity = new Entidade();
        $form   = $this->createForm(
            new EntidadeType(),
            $entity,
            ['action' => $this->generateUrl('entidade_criar')]
        );

        return $this->render('EherQueroSerVoluntarioBundle:Default:newEntidadeForm.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createEntidadeAction()
    {
        $entity  = new Entidade();
        $request = $this->getRequest();
        $form    = $this->createForm(new EntidadeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirect(
                $this->generateUrl('entidade_parabens')
            );
        }

        return $this->render('EherQueroSerVoluntarioBundle:Entidade:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }
}
