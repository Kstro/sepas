<?php

namespace DGPlusbelleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DGPlusbelleBundle\Entity\HistorialConsulta;
use DGPlusbelleBundle\Form\HistorialConsultaType;

/**
 * HistorialConsulta controller.
 *
 * @Route("/admin/historialconsulta")
 */
class HistorialConsultaController extends Controller
{

    /**
     * Lists all HistorialConsulta entities.
     *
     * @Route("/", name="admin_historialconsulta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DGPlusbelleBundle:HistorialConsulta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new HistorialConsulta entity.
     *
     * @Route("/", name="admin_historialconsulta_create")
     * @Method("POST")
     * @Template("DGPlusbelleBundle:HistorialConsulta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new HistorialConsulta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_historialconsulta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a HistorialConsulta entity.
     *
     * @param HistorialConsulta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(HistorialConsulta $entity)
    {
        $form = $this->createForm(new HistorialConsultaType(), $entity, array(
            'action' => $this->generateUrl('admin_historialconsulta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new HistorialConsulta entity.
     *
     * @Route("/new", name="admin_historialconsulta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new HistorialConsulta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a HistorialConsulta entity.
     *
     * @Route("/{id}", name="admin_historialconsulta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:HistorialConsulta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HistorialConsulta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing HistorialConsulta entity.
     *
     * @Route("/{id}/edit", name="admin_historialconsulta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:HistorialConsulta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HistorialConsulta entity.');
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
    * Creates a form to edit a HistorialConsulta entity.
    *
    * @param HistorialConsulta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HistorialConsulta $entity)
    {
        $form = $this->createForm(new HistorialConsultaType(), $entity, array(
            'action' => $this->generateUrl('admin_historialconsulta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing HistorialConsulta entity.
     *
     * @Route("/{id}", name="admin_historialconsulta_update")
     * @Method("PUT")
     * @Template("DGPlusbelleBundle:HistorialConsulta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:HistorialConsulta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HistorialConsulta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_historialconsulta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a HistorialConsulta entity.
     *
     * @Route("/{id}", name="admin_historialconsulta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DGPlusbelleBundle:HistorialConsulta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find HistorialConsulta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_historialconsulta'));
    }

    /**
     * Creates a form to delete a HistorialConsulta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_historialconsulta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
    
    
        
    
    /**
     * 
     *
     * @Route("/signos/data/exp", name="admin_signos_ajax")
     */
    public function datasignosAction(Request $request)
    {
        
        //$entity = new Paciente();
        //$form = $this->createCreateForm($entity);
     

        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $idPaciente = $request->query->get('id');
        $idPaciente=  substr($idPaciente, 1);
        
        $em = $this->getDoctrine()->getEntityManager();
        $expedientesTotal = $em->getRepository('DGPlusbelleBundle:Signos')->findAll();
        
        $paciente['draw']=$draw++;  
        $paciente['recordsTotal'] = count($expedientesTotal);
        $paciente['recordsFiltered']= count($expedientesTotal);
        $paciente['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        if($busqueda['value']!=''){
                                
                    $dql = "SELECT con.id, con.fechaConsulta FROM DGPlusbelleBundle:Consulta "
                        . "WHERE CONCAT(CONCAT(upper(per.nombres),upper(per.apellidos)),exp.numero) LIKE upper(:busqueda) "
                        . "ORDER BY per.nombres ASC ";
                    $paciente['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                    $paciente['recordsFiltered']= count($paciente['data']);
                    
                    $dql = "SELECT exp.numero as expediente, pac.id as id,per.nombres,per.apellidos,DATE_FORMAT(pac.fechaNacimiento,'%d-%m-%Y') as fechaNacimiento, '<a><i style=\"cursor:pointer;\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoPaciente fa fa-info-circle\"></i></a><a style=\"position:absolute; margin-left:10px;\"><i style=\"cursor:pointer;\"  class=\"expPaciente fa fa-list\"></i></a>'  as link FROM DGPlusbelleBundle:Paciente pac "
                        . "JOIN pac.persona per "
                        . "JOIN pac.expediente exp "
                        . "WHERE CONCAT(CONCAT(upper(per.nombres),upper(per.apellidos)),exp.numero) LIKE upper(:busqueda) "
                        . "ORDER BY per.nombres ASC ";
                    $paciente['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
        }
        else{
            $dql = "SELECT DATE_FORMAT(con.fechaConsulta,'%d-%m-%Y') as fecha FROM DGPlusbelleBundle:Consulta con "
                    . "WHERE con.paciente =:id "
                    . "ORDER BY con.fechaConsulta DESC ";
            $paciente['data'] = $em->createQuery($dql)
                    ->setParameters(array('id'=>$idPaciente))
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
            $paciente['recordsTotal'] = count($paciente['data']);
        }
        //$longitud = $request->query->get('length');
        //var_dump($start);
        
//        var_dump(count($paciente['recordsTotal']));
//        die();
        
//        $paciente['recordsFiltered']= count($paciente['data']);
        //var_dump(count($pacientesTotal));
        
        //$array = array("draw"=>23);
//        $paciente['draw']=23;
//        $paciente['recordsTotal']=57;
//        $paciente['recordsFiltered']=57;
        
        
        return new Response(json_encode($paciente));
    
    }
}
