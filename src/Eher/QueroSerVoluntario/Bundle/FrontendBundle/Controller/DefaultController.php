<?php
namespace Eher\QueroSerVoluntario\Bundle\FrontendBundle\Controller;

use Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Entidade;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Voluntario;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Form\EntidadeType;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Form\VoluntarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function newVoluntarioFormAction()
    {
        $entity = new Voluntario();
        $form   = $this->createForm(
            new VoluntarioType(),
            $entity,
            ['action' => $this->generateUrl('voluntario_criar')]
        );

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Default:newVoluntarioForm.html.twig', array(
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

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Voluntario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }
}
