<?php
namespace Eher\QueroSerVoluntario\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Cidade;

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

        $entities = $em->getRepository(Cidade::class)->findAll();

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Cidade:index.html.twig', array(
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

        $entities = $em->getRepository(Cidade::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidade entity.');
        }

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Cidade:show.html.twig', array(
            'entity' => $entity,
        ));
    }

    public function emEstadoAction($estado)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "select c from EherQueroSerVoluntarioDomainBundle:Cidade c JOIN c.estado e WHERE e.nome = ?1"
        );
        $query->setParameter(1, strtoupper($estado));
        $entities = $query->getResult();

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Cidade:em_estado.html.twig', array(
            'entities' => $entities
        ));
    }
}
