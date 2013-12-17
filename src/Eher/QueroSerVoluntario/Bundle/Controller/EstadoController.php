<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Estado;

/**
 * Estado controller.
 *
 */
class EstadoController extends Controller
{
    /**
     * Lists all Estado entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EherQueroSerVoluntarioBundle:Estado')->findAll();

        return $this->render('EherQueroSerVoluntarioBundle:Estado:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Estado entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estado entity.');
        }

        return $this->render('EherQueroSerVoluntarioBundle:Estado:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

}
