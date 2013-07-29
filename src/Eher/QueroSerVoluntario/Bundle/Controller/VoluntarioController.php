<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Voluntario;
use Eher\QueroSerVoluntario\Bundle\Form\VoluntarioType;

/**
 * Voluntario controller.
 *
 */
class VoluntarioController extends Controller
{
    /**
     * Lists all Voluntario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->findAll();

        return $this->render('EherQueroSerVoluntarioBundle:Voluntario:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Voluntario entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Voluntario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioBundle:Voluntario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Voluntario entity.
     *
     */
    public function newAction()
    {
        $entity = new Voluntario();
        $form   = $this->createForm(new VoluntarioType(), $entity);

        return $this->render('EherQueroSerVoluntarioBundle:Voluntario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Voluntario entity.
     *
     */
    public function createAction()
    {
        $entity  = new Voluntario();
        $request = $this->getRequest();
        $form    = $this->createForm(new VoluntarioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

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

    /**
     * Displays a form to edit an existing Voluntario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Voluntario entity.');
        }

        $editForm = $this->createForm(new VoluntarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioBundle:Voluntario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Voluntario entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Voluntario entity.');
        }

        $editForm   = $this->createForm(new VoluntarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('voluntario_edit', array('id' => $id)));
        }

        return $this->render('EherQueroSerVoluntarioBundle:Voluntario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Voluntario entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Voluntario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('voluntario'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
