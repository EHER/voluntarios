<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Voluntario;
use Eher\QueroSerVoluntario\Bundle\Form\VoluntarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        $entityManager = $this->getDoctrine()->getManager();
        $dql = "SELECT voluntario FROM EherQueroSerVoluntarioBundle:Voluntario voluntario JOIN voluntario.cidade cidade";
        $query = $entityManager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            10
        );

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
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

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
                $this->generateUrl('voluntario')
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
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

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
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Voluntario entity.');
        }

        $editForm   = $this->createForm(new VoluntarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('voluntario_edit', array('id' => $id)));
        }

        return $this->render('EherQueroSerVoluntarioBundle:Voluntario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function mailAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Voluntario entity.');
            }

            $this->get("mail_manager")
                ->setContactEmail(
                    $this->container->getParameter("contact_email")
                )
                ->generateMessageWithVoluntario($entity)
                ->send();
        }

        return $this->redirect($this->generateUrl('voluntario'));
    }

    /**
     * Deletes a Voluntario entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Voluntario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Voluntario entity.');
            }

            $entityManager->remove($entity);
            $entityManager->flush();
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
