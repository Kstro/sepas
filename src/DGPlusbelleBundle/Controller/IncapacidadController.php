<?php

namespace DGPlusbelleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DGPlusbelleBundle\Entity\Incapacidad;
use DGPlusbelleBundle\Entity\Paciente;
use DGPlusbelleBundle\Form\IncapacidadType;

/**
 * Incapacidad controller.
 *
 * @Route("/admin/incapacidad")
 */
class IncapacidadController extends Controller
{

    /**
     * Lists all Incapacidad entities.
     *
     * @Route("/", name="admin_incapacidad")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        
        $entity = new Incapacidad();
        $form = $this->createCreateForm($entity);
        
        $entities = $em->getRepository('DGPlusbelleBundle:Incapacidad')->findAll();

        return array(
            'form'=>$form->createView(),
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Incapacidad entity.
     *
     * @Route("/", name="admin_incapacidad_create")
     * @Method("POST")
     * @Template("DGPlusbelleBundle:Incapacidad:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Incapacidad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
 
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setEmpleado($user->getPersona()->getEmpleado()[0]);
            $entity->setFechaRegistro(new \DateTime('now'));
            $em->persist($entity);
            $em->flush();

//            return $this->redirect($this->generateUrl('admin_incapacidad_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('admin_incapacidad'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Incapacidad entity.
     *
     * @param Incapacidad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Incapacidad $entity)
    {
        $form = $this->createForm(new IncapacidadType(), $entity, array(
            'action' => $this->generateUrl('admin_incapacidad_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar','attr'=>
                                                        array('class'=>'btn btn-primary btn-sm')
         ));

        return $form;
    }

    /**
     * Displays a form to create a new Incapacidad entity.
     *
     * @Route("/new", name="admin_incapacidad_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Incapacidad();
        
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $cadena= $request->get('id');
        $idEntidad = substr($cadena, 1);

        if($idEntidad!=0){
            $paciente = $em->getRepository('DGPlusbelleBundle:Paciente')->find($idEntidad);
            $entity->setPaciente($paciente);
        }
        else{
            $paciente = $em->getRepository('DGPlusbelleBundle:Paciente')->findAll();
        }
        
        
        
        $form   = $this->createCreateForm($entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Incapacidad entity.
     *
     * @Route("/{id}", name="admin_incapacidad_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:Incapacidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Incapacidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Incapacidad entity.
     *
     * @Route("/{id}/edit", name="admin_incapacidad_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:Incapacidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Incapacidad entity.');
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
    * Creates a form to edit a Incapacidad entity.
    *
    * @param Incapacidad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Incapacidad $entity)
    {
        $form = $this->createForm(new IncapacidadType(), $entity, array(
            'action' => $this->generateUrl('admin_incapacidad_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modificar','attr'=>
                                                        array('class'=>'btn btn-primary btn-sm')
         ));

        return $form;
    }
    /**
     * Edits an existing Incapacidad entity.
     *
     * @Route("/{id}", name="admin_incapacidad_update")
     * @Method("PUT")
     * @Template("DGPlusbelleBundle:Incapacidad:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:Incapacidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Incapacidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

//            return $this->redirect($this->generateUrl('admin_incapacidad_edit', array('id' => $id)));
            return $this->redirect($this->generateUrl('admin_incapacidad_index' ));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Incapacidad entity.
     *
     * @Route("/{id}", name="admin_incapacidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DGPlusbelleBundle:Incapacidad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Incapacidad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_incapacidad'));
    }

    /**
     * Creates a form to delete a Incapacidad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_incapacidad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
    
    
    /**
     * 
     *
     * @Route("/incapacidad/data", name="admin_incapacidad_data")
     */
    public function dataincapacidadAction(Request $request)
    {
        $entity = new Incapacidad();
        $form = $this->createCreateForm($entity);
        

        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        $id = $request->query->get('id');
        
        $em = $this->getDoctrine()->getEntityManager();
        $expedientesTotal = $em->getRepository('DGPlusbelleBundle:Incapacidad')->findAll();
        
        $paciente['draw']=$draw++;  
        $paciente['recordsTotal'] = count($expedientesTotal);
        $paciente['recordsFiltered']= count($expedientesTotal);
        $paciente['data']= array();
        
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        if($busqueda['value']!=''){
            
                    
                    $dql = "SELECT exp.numero as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaInicial,'%d-%m-%Y') as fechaInicial, DATE_FORMAT(inc.fechaFinal,'%d-%m-%Y') as fechaFinal,inc.notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
                        . "JOIN inc.paciente pac "
                        . "JOIN pac.persona per "
                        . "JOIN pac.expediente exp "
                        . "WHERE CONCAT(upper(per.nombres),upper(per.apellidos)) LIKE upper(:busqueda) "
                        . "ORDER BY per.nombres ASC ";
                    
                    $paciente['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                    $paciente['recordsFiltered']= count($paciente['data']);
                    
                    $dql = "SELECT exp.numero as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaInicial,'%d-%m-%Y') as fechaInicial, DATE_FORMAT(inc.fechaFinal,'%d-%m-%Y') as fechaFinal,inc.notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
                        . "JOIN inc.paciente pac "
                        . "JOIN pac.persona per "
                        . "JOIN pac.expediente exp "
                        . "WHERE CONCAT(upper(per.nombres),upper(per.apellidos)) LIKE upper(:busqueda) "
                        . "ORDER BY per.nombres ASC ";
                    
                    $paciente['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
        }
        else{
//            $dql = "SELECT exp.numero as expediente, pac.id as id,CONCAT(per.nombres, per.apellidos) as nombres, '<a ><i style=\"cursor:pointer;\"  class=\"infoPaciente fa fa-info-circle\"></i></a>' as link FROM DGPlusbelleBundle:Incapacidad inc "
            $dql = "SELECT exp.numero as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaInicial,'%d-%m-%Y') as fechaInicial, DATE_FORMAT(inc.fechaFinal,'%d-%m-%Y') as fechaFinal,CONCAT(SUBSTRING(inc.notas,1,20),'...') as notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
                . "JOIN inc.paciente pac "
                . "JOIN pac.persona per "
                . "JOIN pac.expediente exp "
                . "WHERE pac.id=:id ORDER BY inc.id DESC ";
            $paciente['data'] = $em->createQuery($dql)
                    ->setParameter('id',$id)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
        }
        //$longitud = $request->query->get('length');
        //var_dump($start);
        
        //var_dump(count($pacientesTotal));
        
        //$array = array("draw"=>23);
//        $paciente['draw']=23;
//        $paciente['recordsTotal']=57;
//        $paciente['recordsFiltered']=57;
        
        
        return new Response(json_encode($paciente));
    }
    
    
    
    
    
    
    /**
     * 
     *
     * @Route("/incapacidad/data/consulta/guardar", name="admin_consulta_guardar_incapacidad_ajax")
     */
    public function dataConsultaAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $incapacidad = new Incapacidad();

        
        $idPaciente = $request->get('idPaciente');
        $idEmpleado = 1;
        $fechaInicio = $request->get('fechaInicio');
        $fechaFin = $request->get('fechaFin');
        $notas = $request->get('notas');
//        var_dump($fechaInicio);
//        var_dump($fechaFin);
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $pacienteObj = $em->getRepository('DGPlusbelleBundle:Paciente')->find($idPaciente);
        $empleadoObj = $em->getRepository('DGPlusbelleBundle:Empleado')->find(1); //Sepes solo el dr
        
        
        $incapacidad->setFechaInicial(new \DateTime($fechaInicio));
        $incapacidad->setFechaFinal(new \DateTime($fechaFin));
        $incapacidad->setFechaRegistro(new \DateTime('now'));
        
        $incapacidad->setNotas($notas);
        $incapacidad->setPaciente($pacienteObj);
        $incapacidad->setEmpleado($empleadoObj);
        
        $em->persist($incapacidad);
        $em->flush();
        
        return new Response(json_encode(0));
        
    }
    
    
    
    
    
    
    /**
     * 
     *
     * @Route("/incapacidad/data/consulta/eliminar", name="admin_consulta_eliminar_incapacidad_ajax")
     */
    public function dataEliminarIncapacidadAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        

        
        $idIncapacidad = $request->get('id');
        
//        var_dump($fechaInicio);
//        var_dump($fechaFin);
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $incapacidadObj = $em->getRepository('DGPlusbelleBundle:Incapacidad')->find($idIncapacidad);
        
        
        
        
        $em->remove($incapacidadObj);
        $em->flush();
        
        return new Response(json_encode(0));
        
        
        
        
    }
    
    
    
    
    
    /**
     * 
     *
     * @Route("/incapacidad/data/todo", name="admin_incapacidad_data_todo")
     */
    public function dataIncapacidadTodoAction(Request $request)
    {
        
        
        

        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $expedientesTotal = $em->getRepository('DGPlusbelleBundle:Incapacidad')->findAll();
        
        $paciente['draw']=$draw++;  
        $paciente['recordsTotal'] = count($expedientesTotal);
        $paciente['recordsFiltered']= count($expedientesTotal);
        $paciente['data']= array();
        
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        if($busqueda['value']!=''){
            
                    
                    $dql = "SELECT exp.numero as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaInicial,'%d-%m-%Y') as fechaInicial, DATE_FORMAT(inc.fechaFinal,'%d-%m-%Y') as fechaFinal,inc.notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
                        . "JOIN inc.paciente pac "
                        . "JOIN pac.persona per "
                        . "JOIN pac.expediente exp "
                        . "WHERE CONCAT(upper(per.nombres),upper(per.apellidos)) LIKE upper(:busqueda) "
                        . "ORDER BY per.nombres ASC ";
                    
                    $paciente['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                    $paciente['recordsFiltered']= count($paciente['data']);
                    
                    $dql = "SELECT exp.numero as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaInicial,'%d-%m-%Y') as fechaInicial, DATE_FORMAT(inc.fechaFinal,'%d-%m-%Y') as fechaFinal,inc.notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
                        . "JOIN inc.paciente pac "
                        . "JOIN pac.persona per "
                        . "JOIN pac.expediente exp "
                        . "WHERE CONCAT(upper(per.nombres),upper(per.apellidos)) LIKE upper(:busqueda) "
                        . "ORDER BY per.nombres ASC ";
                    
                    $paciente['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
        }
        else{
//            $dql = "SELECT exp.numero as expediente, pac.id as id,CONCAT(per.nombres, per.apellidos) as nombres, '<a ><i style=\"cursor:pointer;\"  class=\"infoPaciente fa fa-info-circle\"></i></a>' as link FROM DGPlusbelleBundle:Incapacidad inc "
            $dql = "SELECT CONCAT('<a class=\"link_expediente\" id=\"',inc.id,'\">',exp.numero,'</a>') as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaRegistro,'%d-%m-%Y %H:%i') as fechaRegistro, CONCAT(SUBSTRING(inc.notas,1,20),'...') as notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
                . "JOIN inc.paciente pac "
                . "JOIN pac.persona per "
                . "JOIN pac.expediente exp "
                . "ORDER BY inc.fechaRegistro DESC ";
            
            $paciente['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
        }
        //$longitud = $request->query->get('length');
        //var_dump($start);
        
        //var_dump(count($pacientesTotal));
        
        //$array = array("draw"=>23);
//        $paciente['draw']=23;
//        $paciente['recordsTotal']=57;
//        $paciente['recordsFiltered']=57;
        
        
        return new Response(json_encode($paciente));
    }
    
    
    
}
