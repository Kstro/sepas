<?php

namespace DGPlusbelleBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DGPlusbelleBundle\Entity\TipoConsulta;
use DGPlusbelleBundle\Form\TipoConsultaType;

/**
 * TipoConsulta controller.
 *
 * @Route("/admin/tipoconsulta")
 */
class TipoConsultaController extends Controller
{

    /**
     * Lists all TipoConsulta entities.
     *
     * @Route("/", name="admin_tipoconsulta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $entity = new TipoConsulta();
        $form = $this->createCreateForm($entity);
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DGPlusbelleBundle:TipoConsulta')->findBy(array('estado' => true));

        return array(
            'entities' => $entities,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    /**
     * Creates a new TipoConsulta entity.
     *
     * @Route("/", name="admin_tipoconsulta_create")
     * @Method("POST")
     * @Template("DGPlusbelleBundle:TipoConsulta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoConsulta();
        $entity->setEstado(true);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tipoconsulta', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoConsulta entity.
     *
     * @param TipoConsulta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoConsulta $entity)
    {
        $form = $this->createForm(new TipoConsultaType(), $entity, array(
            'action' => $this->generateUrl('admin_tipoconsulta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar',
                                               'attr'=>
                                                        array('class'=>'btn btn-primary btn-sm')));

        return $form;
    }

    /**
     * Displays a form to create a new TipoConsulta entity.
     *
     * @Route("/new", name="admin_tipoconsulta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoConsulta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoConsulta entity.
     *
     * @Route("/{id}", name="admin_tipoconsulta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:TipoConsulta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoConsulta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoConsulta entity.
     *
     * @Route("/{id}/edit", name="admin_tipoconsulta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:TipoConsulta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoConsulta entity.');
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
    * Creates a form to edit a TipoConsulta entity.
    *
    * @param TipoConsulta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoConsulta $entity)
    {
        $form = $this->createForm(new TipoConsultaType(), $entity, array(
            'action' => $this->generateUrl('admin_tipoconsulta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modificar',
                                               'attr'=>
                                                        array('class'=>'btn btn-primary btn-sm')));

        return $form;
    }
    /**
     * Edits an existing TipoConsulta entity.
     *
     * @Route("/{id}", name="admin_tipoconsulta_update")
     * @Method("PUT")
     * @Template("DGPlusbelleBundle:TipoConsulta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:TipoConsulta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoConsulta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tipoconsulta'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoConsulta entity.
     *
     * @Route("/{id}", name="admin_tipoconsulta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DGPlusbelleBundle:TipoConsulta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoConsulta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_tipoconsulta'));
    }

    /**
     * Creates a form to delete a TipoConsulta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tipoconsulta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
    /**
     * Deletes a TipoConsualta entity.
     *
     * @Route("/desactivar_tipoconsulta/{id}", name="admin_tipoconsulta_desactivar", options={"expose"=true})
     * @Method("GET")
     */
    public function desactivarAction(Request $request, $id)
    {
        //$form = $this->createDeleteForm($id);
        //$form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DGPlusbelleBundle:TipoConsulta')->find($id);
        
         if($entity->getEstado()==0){
            $entity->setEstado(1);
            $exito['regs']=1;//registro activado
        }
        else{
            $entity->setEstado(0);
            $exito['regs']=0;//registro desactivado
        }
        
        $em->persist($entity);
        $em->flush();
        
        return new Response(json_encode($exito));
        
    }
}
