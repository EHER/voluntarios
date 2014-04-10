<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Vaga;
use Eher\QueroSerVoluntario\Bundle\Form\VagaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vaga controller.
 *
 */
class VagaController extends Controller
{
    /**
     * Lists all Vaga entities.
     *
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Vaga');
        $queryBuilder = $repository->createQueryBuilder('vaga')
            ->join('vaga.entidade', 'entidade')
            ->join('entidade.cidade', 'cidade')
            ;

        $cidade = $this->get('request')->query->get('cidade');
        if (!empty($cidade)) {
            $queryBuilder->orWhere('cidade.nome = :cidade')
                ->setParameter('cidade', $cidade);
        }

        $online = $this->get('request')->query->get('online');
        if (!empty($online)) {
            $queryBuilder->orWhere('vaga.online = :online')
                ->setParameter('online', $online);
        }

        $query = $queryBuilder->getQuery();

        $paginator  = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            10
        );

        return $this->render('EherQueroSerVoluntarioBundle:Vaga:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Vaga entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Vaga();
        $form = $this->createForm(new VagaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('vaga_show', array('id' => $entity->getId())));
        }

        return $this->render('EherQueroSerVoluntarioBundle:Vaga:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Vaga entity.
     *
     */
    public function newAction()
    {
        $entity = new Vaga();
        $form   = $this->createForm(new VagaType(), $entity);

        return $this->render('EherQueroSerVoluntarioBundle:Vaga:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vaga entity.
     *
     */
    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaga entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioBundle:Vaga:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Vaga entity.
     *
     */
    public function editAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaga entity.');
        }

        $editForm = $this->createForm(new VagaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioBundle:Vaga:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Vaga entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaga entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VagaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('vaga_edit', array('id' => $id)));
        }

        return $this->render('EherQueroSerVoluntarioBundle:Vaga:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vaga entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entity = $entityManager->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vaga entity.');
            }

            $entityManager->remove($entity);
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('vaga'));
    }

    /**
     * Creates a form to delete a Vaga entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
