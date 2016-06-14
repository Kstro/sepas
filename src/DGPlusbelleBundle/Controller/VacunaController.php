<?php

namespace DGPlusbelleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DGPlusbelleBundle\Entity\Vacuna;
use DGPlusbelleBundle\Form\VacunaType;

/**
 * Vacuna controller.
 *
 * @Route("/admin/vacuna")
 */
class VacunaController extends Controller
{

    /**
     * Lists all Vacuna entities.
     *
     * @Route("/", name="admin_vacuna")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

//        $entities = $em->getRepository('DGPlusbelleBundle:Vacuna')->findBy(array('estado'=>1));
        $entities = $em->getRepository('DGPlusbelleBundle:Vacuna')->findAll();
        $entity = new Vacuna();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        return array(
            'entities' => $entities,
            'form'   => $form->createView(),
        );
    }
    /**
     * Creates a new Vacuna entity.
     *
     * @Route("/", name="admin_vacuna_create")
     * @Method("POST")
     * @Template("DGPlusbelleBundle:Vacuna:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vacuna();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setEstado(1);
            $em->persist($entity);
            $em->flush();

//            return $this->redirect($this->generateUrl('admin_vacuna_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('admin_vacuna'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Vacuna entity.
     *
     * @param Vacuna $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vacuna $entity)
    {
        $form = $this->createForm(new VacunaType(), $entity, array(
            'action' => $this->generateUrl('admin_vacuna_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar',
                                               'attr'=>
                                                        array('class'=>'btn btn-primary btn-sm')));

        return $form;
    }

    /**
     * Displays a form to create a new Vacuna entity.
     *
     * @Route("/new", name="admin_vacuna_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vacuna();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vacuna entity.
     *
     * @Route("/{id}", name="admin_vacuna_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vacuna entity.
     *
     * @Route("/{id}/edit", name="admin_vacuna_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
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
    * Creates a form to edit a Vacuna entity.
    *
    * @param Vacuna $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vacuna $entity)
    {
        $form = $this->createForm(new VacunaType(), $entity, array(
            'action' => $this->generateUrl('admin_vacuna_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modificar',
                                               'attr'=>
                                                        array('class'=>'btn btn-primary btn-sm')));

        return $form;
    }
    /**
     * Edits an existing Vacuna entity.
     *
     * @Route("/{id}", name="admin_vacuna_update")
     * @Method("PUT")
     * @Template("DGPlusbelleBundle:Vacuna:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            //return $this->redirect($this->generateUrl('admin_vacuna_edit', array('id' => $id)));
            return $this->redirect($this->generateUrl('admin_vacuna'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vacuna entity.
     *
     * @Route("/{id}", name="admin_vacuna_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DGPlusbelleBundle:Vacuna')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vacuna entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_vacuna'));
    }

    /**
     * Creates a form to delete a Vacuna entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_vacuna_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    /**
     * Deletes a Vacuna entity.
     *
     * @Route("/desactivar_vacuna/{id}", name="admin_vacuna_desactivar", options={"expose"=true})
     * @Method("GET")
     */
    public function desactivarAction(Request $request, $id)
    {
        //$form = $this->createDeleteForm($id);
        //$form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DGPlusbelleBundle:Vacuna')->find($id);
        
        if($entity->getEstado()==0){
            $entity->setEstado(1);
            $exito['regs']=1;//registro activado
        }
        else{
            $entity->setEstado(0);
            $exito['regs']=0;//registro desactivado
        }
        
        $em->merge($entity);
        $em->flush();
        
        return new Response(json_encode($exito));
        
    }
}
