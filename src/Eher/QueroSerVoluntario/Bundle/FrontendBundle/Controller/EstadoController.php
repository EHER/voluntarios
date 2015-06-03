<?php
namespace Eher\QueroSerVoluntario\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Estado;

class EstadoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Estado::class)->findAll();

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Estado:index.html.twig', ['entities' => $entities]);
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Estado::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estado entity.');
        }

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Estado:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
