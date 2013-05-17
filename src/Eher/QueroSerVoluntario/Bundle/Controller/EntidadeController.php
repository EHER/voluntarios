<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Entidade;
use Eher\QueroSerVoluntario\Bundle\Form\EntidadeType;

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
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EherQueroSerVoluntarioBundle:Entidade')->findAll();

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
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

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
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('entidade_parabens')
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
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

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
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entidade entity.');
        }

        $editForm   = $this->createForm(new EntidadeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

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

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Entidade')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Entidade entity.');
            }

            $em->remove($entity);
            $em->flush();
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
