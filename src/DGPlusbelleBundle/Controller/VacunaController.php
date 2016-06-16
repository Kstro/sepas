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
    
    
    
    /**
     * 
     *
     * @Route("/abono/data/listado/vacuna/aplicacion", name="admin_abonos_paciente_data_vacuna_aplicacion")
     */
    public function dataAbonoVacunaAplicacionAction(Request $request)
    {
           

        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        $id = $request->query->get('id');
        //var_dump($id);
        $em = $this->getDoctrine()->getEntityManager();
        $expedientesTotal = $em->getRepository('DGPlusbelleBundle:AplicacionVacuna')->findBy(array('ventaVacuna'=>$id));
        
        $paciente['draw']=$draw++;  
        $paciente['recordsTotal'] = count($expedientesTotal);
        $paciente['recordsFiltered']= count($expedientesTotal);
        $paciente['data']= array();
        
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        if($busqueda['value']!=''){
            
                    
//                    $dql = "SELECT exp.numero as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaInicial,'%d-%m-%Y') as fechaInicial, DATE_FORMAT(inc.fechaFinal,'%d-%m-%Y') as fechaFinal,inc.notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
//                        . "JOIN inc.paciente pac "
//                        . "JOIN pac.persona per "
//                        . "JOIN pac.expediente exp "
//                        . "WHERE CONCAT(upper(per.nombres),upper(per.apellidos)) LIKE upper(:busqueda) "
//                        . "ORDER BY per.nombres ASC ";
//                    
//                    $paciente['data'] = $em->createQuery($dql)
//                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
//                            ->getResult();
//                    
//                    $paciente['recordsFiltered']= count($paciente['data']);
//                    
//                    $dql = "SELECT exp.numero as expediente, inc.id as id,CONCAT(CONCAT(per.nombres,' '), per.apellidos) as nombres, DATE_FORMAT(inc.fechaInicial,'%d-%m-%Y') as fechaInicial, DATE_FORMAT(inc.fechaFinal,'%d-%m-%Y') as fechaFinal,inc.notas, concat(concat('<a id=\"',inc.id),'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"infoIncapacidad fa fa-list-alt\"></i></a>','<a style=\"margin-left:5px;\" id=\"',inc.id,'\"><i style=\"cursor:pointer;color:#000\" data-toggle=\"tooltip\" data-original-title=\"Atrás\" class=\"eliminarIncapacidad fa fa-times\"></i></a>')  as link FROM DGPlusbelleBundle:Incapacidad inc "
//                        . "JOIN inc.paciente pac "
//                        . "JOIN pac.persona per "
//                        . "JOIN pac.expediente exp "
//                        . "WHERE CONCAT(upper(per.nombres),upper(per.apellidos)) LIKE upper(:busqueda) "
//                        . "ORDER BY per.nombres ASC ";
//                    
//                    $paciente['data'] = $em->createQuery($dql)
//                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
//                            ->setFirstResult($start)
//                            ->setMaxResults($longitud)
//                            ->getResult();
        }
        else{
//            $dql = "SELECT exp.numero as expediente, pac.id as id,CONCAT(per.nombres, per.apellidos) as nombres, '<a ><i style=\"cursor:pointer;\"  class=\"infoPaciente fa fa-info-circle\"></i></a>' as link FROM DGPlusbelleBundle:Incapacidad inc "
            $dql = "SELECT DATE_FORMAT(apvac.fechaAplicacion,'%d-%m-%Y %H:%i') as fechaAplicacion, CONCAT(per.nombres,' ', per.apellidos) as empleado, vac.nombre as vacuna FROM DGPlusbelleBundle:AplicacionVacuna apvac "
                    . "JOIN apvac.empleado emp "
                    . "JOIN emp.persona per "
                    . "JOIN apvac.vacuna vac "
                    //. "JOIN ab.sucursal suc "
                    . "WHERE apvac.ventaVacuna=:id "
                    . "ORDER BY apvac.fechaAplicacion DESC ";
            $paciente['data'] = $em->createQuery($dql)
                    ->setParameter('id',$id)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
            $paciente['recordsTotal'] = count($paciente['data']);
            //$paciente['recordsFiltered']= count($expedientesTotal);
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
