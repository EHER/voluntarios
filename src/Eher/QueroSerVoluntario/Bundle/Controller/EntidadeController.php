<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Entidade;
use Eher\QueroSerVoluntario\Bundle\Form\EntidadeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Entidade controller.
 *
 */
class EntidadeController extends Controller
{
    /**
     * Lists all Entidade entities.
     *
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $dql = "SELECT entidade FROM EherQueroSerVoluntarioBundle:Entidade entidade JOIN entidade.cidade cidade order by entidade.id desc";
        $query = $entityManager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            10
        );

        return $this->render('EherQueroSerVoluntarioBundle:Entidade:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Entidade entity.
     *
     */
    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entidade entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioBundle:Entidade:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Entidade entity.
     *
     */
    public function newAction()
    {
        $entity = new Entidade();
        $form   = $this->createForm(new EntidadeType(), $entity);

        return $this->render('EherQueroSerVoluntarioBundle:Entidade:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Entidade entity.
     *
     */
    public function createAction()
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
                $this->generateUrl('entidade')
            );
        }

        return $this->render('EherQueroSerVoluntarioBundle:Entidade:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Entidade entity.
     *
     */
    public function editAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entidade entity.');
        }

        $editForm = $this->createForm(new EntidadeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioBundle:Entidade:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Entidade entity.
     *
     */
    public function updateAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entidade entity.');
        }

        $editForm   = $this->createForm(new EntidadeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('entidade_edit', array('id' => $id)));
        }

        return $this->render('EherQueroSerVoluntarioBundle:Entidade:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Entidade entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Entidade entity.');
            }

            $entityManager->remove($entity);
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('entidade'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
