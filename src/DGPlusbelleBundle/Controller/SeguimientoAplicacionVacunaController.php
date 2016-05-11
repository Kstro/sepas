<?php

namespace DGPlusbelleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DGPlusbelleBundle\Entity\SeguimientoAplicacionVacuna;
use DGPlusbelleBundle\Form\SeguimientoAplicacionVacunaType;

/**
 * SeguimientoAplicacionVacuna controller.
 *
 * @Route("/admin/seguimiento-aplicacionvacuna")
 */
class SeguimientoAplicacionVacunaController extends Controller
{

    /**
     * Lists all SeguimientoAplicacionVacuna entities.
     *
     * @Route("/", name="admin_seguimiento_aplicacionvacuna")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DGPlusbelleBundle:SeguimientoAplicacionVacuna')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SeguimientoAplicacionVacuna entity.
     *
     * @Route("/", name="admin_seguimiento_aplicacionvacuna_create")
     * @Method("POST")
     * @Template("DGPlusbelleBundle:SeguimientoAplicacionVacuna:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SeguimientoAplicacionVacuna();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_seguimiento_aplicacionvacuna_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a SeguimientoAplicacionVacuna entity.
     *
     * @param SeguimientoAplicacionVacuna $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SeguimientoAplicacionVacuna $entity)
    {
        $form = $this->createForm(new SeguimientoAplicacionVacunaType(), $entity, array(
            'action' => $this->generateUrl('admin_seguimiento_aplicacionvacuna_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SeguimientoAplicacionVacuna entity.
     *
     * @Route("/new", name="admin_seguimiento_aplicacionvacuna_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SeguimientoAplicacionVacuna();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SeguimientoAplicacionVacuna entity.
     *
     * @Route("/{id}", name="admin_seguimiento_aplicacionvacuna_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:SeguimientoAplicacionVacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SeguimientoAplicacionVacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SeguimientoAplicacionVacuna entity.
     *
     * @Route("/{id}/edit", name="admin_seguimiento_aplicacionvacuna_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:SeguimientoAplicacionVacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SeguimientoAplicacionVacuna entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a SeguimientoAplicacionVacuna entity.
    *
    * @param SeguimientoAplicacionVacuna $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SeguimientoAplicacionVacuna $entity)
    {
        $form = $this->createForm(new SeguimientoAplicacionVacunaType(), $entity, array(
            'action' => $this->generateUrl('admin_seguimiento_aplicacionvacuna_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SeguimientoAplicacionVacuna entity.
     *
     * @Route("/{id}", name="admin_seguimiento_aplicacionvacuna_update")
     * @Method("PUT")
     * @Template("DGPlusbelleBundle:SeguimientoAplicacionVacuna:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:SeguimientoAplicacionVacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SeguimientoAplicacionVacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_seguimiento_aplicacionvacuna_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SeguimientoAplicacionVacuna entity.
     *
     * @Route("/{id}", name="admin_seguimiento_aplicacionvacuna_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DGPlusbelleBundle:SeguimientoAplicacionVacuna')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SeguimientoAplicacionVacuna entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_seguimiento_aplicacionvacuna'));
    }

    /**
     * Creates a form to delete a SeguimientoAplicacionVacuna entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_seguimiento_aplicacionvacuna_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
