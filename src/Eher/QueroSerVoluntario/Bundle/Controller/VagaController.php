<?php

namespace Eher\QueroSerVoluntario\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Eher\QueroSerVoluntario\Bundle\Entity\Vaga;
use Eher\QueroSerVoluntario\Bundle\Form\VagaType;

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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EherQueroSerVoluntarioBundle:Vaga')->findAll();

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
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaga entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VagaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

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
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EherQueroSerVoluntarioBundle:Vaga')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vaga entity.');
            }

            $em->remove($entity);
            $em->flush();
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
