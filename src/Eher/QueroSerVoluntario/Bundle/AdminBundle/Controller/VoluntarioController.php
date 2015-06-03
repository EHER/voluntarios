<?php
namespace Eher\QueroSerVoluntario\Bundle\AdminBundle\Controller;

use Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Voluntario;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Form\VoluntarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VoluntarioController extends Controller
{
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $dql = "SELECT voluntario FROM EherQueroSerVoluntarioDomainBundle:Voluntario voluntario JOIN voluntario.cidade cidade order by voluntario.id desc";
        $query = $entityManager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            10
        );

        return $this->render('EherQueroSerVoluntarioAdminBundle:Voluntario:index.html.twig', [
            'entities' => $entities
        ]);
    }

    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioDomainBundle:Voluntario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Voluntario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioAdminBundle:Voluntario:show.html.twig', [
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ]);
    }

    public function newAction()
    {
        $entity = new Voluntario();
        $form   = $this->createForm(
            new VoluntarioType(),
            $entity,
            ['action' => $this->generateUrl('voluntario_create')]
        );

        return $this->render('EherQueroSerVoluntarioAdminBundle:Voluntario:new.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView()
        ]);
    }

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

        return $this->render('EherQueroSerVoluntarioAdminBundle:Voluntario:new.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView()
        ]);
    }

    /**
     * Displays a form to edit an existing Voluntario entity.
     *
     */
    public function editAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioDomainBundle:Voluntario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Voluntario entity.');
        }

        $editForm = $this->createForm(new VoluntarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EherQueroSerVoluntarioAdminBundle:Voluntario:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Edits an existing Voluntario entity.
     *
     */
    public function updateAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('EherQueroSerVoluntarioDomainBundle:Voluntario')->find($id);

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

            return $this->redirect($this->generateUrl('voluntario_edit', ['id' => $id]));
        }

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Voluntario:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    public function mailAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entity = $entityManager->getRepository('EherQueroSerVoluntarioDomainBundle:Voluntario')->find($id);

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
            $entity = $entityManager->getRepository('EherQueroSerVoluntarioDomainBundle:Voluntario')->find($id);

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
        return $this->createFormBuilder(['id' => $id])
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
