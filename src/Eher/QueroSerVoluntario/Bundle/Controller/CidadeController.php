<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Cidade;

/**
 * Cidade controller.
 *
 */
class CidadeController extends Controller
{
    /**
     * Lists all Cidade entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EherQueroSerVoluntarioBundle:Cidade')->findAll();

        return $this->render('EherQueroSerVoluntarioBundle:Cidade:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Cidade entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Cidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidade entity.');
        }

        return $this->render('EherQueroSerVoluntarioBundle:Cidade:show.html.twig', array(
            'entity' => $entity,
        ));
    }

    public function emEstadoAction($estado)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("select c from EherQueroSerVoluntarioBundle:Cidade c JOIN c.estado e WHERE e.nome = ?1");
        $query->setParameter(1, $estado);
        $entities = $query->getResult();

        return $this->render('EherQueroSerVoluntarioBundle:Cidade:em_estado.html.twig', array(
            'entities' => $entities
        ));
    }
}
