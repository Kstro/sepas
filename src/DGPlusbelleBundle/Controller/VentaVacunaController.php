<?php

namespace DGPlusbelleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DGPlusbelleBundle\Entity\VentaVacuna;
use DGPlusbelleBundle\Entity\Medicamento;
use DGPlusbelleBundle\Form\VentaVacunaType;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * VentaVacuna controller.
 *
 * @Route("/admin/venta/vacuna")
 */
class VentaVacunaController extends Controller
{

    /**
     * Lists all VentaVacuna entities.
     *
     * @Route("/", name="admin_venta_vacuna")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DGPlusbelleBundle:VentaVacuna')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new VentaVacuna entity.
     *
     * @Route("/", name="admin_venta_vacuna_create")
     * @Method("POST")
     * @Template("DGPlusbelleBundle:VentaVacuna:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new VentaVacuna();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_venta_vacuna_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a VentaVacuna entity.
     *
     * @param VentaVacuna $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VentaVacuna $entity)
    {
        $form = $this->createForm(new VentaVacunaType(), $entity, array(
            'action' => $this->generateUrl('admin_venta_vacuna_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VentaVacuna entity.
     *
     * @Route("/new", name="admin_venta_vacuna_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new VentaVacuna();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a VentaVacuna entity.
     *
     * @Route("/{id}", name="admin_venta_vacuna_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:VentaVacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VentaVacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing VentaVacuna entity.
     *
     * @Route("/{id}/edit", name="admin_venta_vacuna_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:VentaVacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VentaVacuna entity.');
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
    * Creates a form to edit a VentaVacuna entity.
    *
    * @param VentaVacuna $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VentaVacuna $entity)
    {
        $form = $this->createForm(new VentaVacunaType(), $entity, array(
            'action' => $this->generateUrl('admin_venta_vacuna_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VentaVacuna entity.
     *
     * @Route("/{id}", name="admin_venta_vacuna_update")
     * @Method("PUT")
     * @Template("DGPlusbelleBundle:VentaVacuna:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DGPlusbelleBundle:VentaVacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VentaVacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_venta_vacuna_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a VentaVacuna entity.
     *
     * @Route("/{id}", name="admin_venta_vacuna_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DGPlusbelleBundle:VentaVacuna')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VentaVacuna entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_venta_vacuna'));
    }

    /**
     * Creates a form to delete a VentaVacuna entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_venta_vacuna_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    /**
    * Ajax utilizado para registrar una nueva venta de vacunas
    *  
    * @Route("/registro-vacuna/nueva-venta/set", name="admin_registro_nueva_venta_vacuna")
    */
    public function registrarNuevaVentaVacunaAction()
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();
            $usuario= $this->get('security.token_storage')->getToken()->getUser();
            
            $id = $this->get('request')->request->get('id');
            $empleadoId = $this->get('request')->request->get('empleado');
            $cuotas = $this->get('request')->request->get('cuotas');
            $valores = $this->get('request')->request->get('valores');
            $descuentoId = $this->get('request')->request->get('descuento');
            $observaciones = $this->get('request')->request->get('observaciones');
            
            $ventaVacuna = new VentaVacuna();
            
            $paciente = $em->getRepository('DGPlusbelleBundle:Paciente')->find($id);
            $ventaVacuna->setPaciente($paciente);
            
            if(!is_null($empleadoId) && $empleadoId != ''){
                $empleado = $em->getRepository('DGPlusbelleBundle:Empleado')->find($empleadoId);
                $ventaVacuna->setEmpleado($empleado);
            }
            
            $ventaVacuna->setCuotas($cuotas);
            
            if(!is_null($descuentoId)){
                $descuento = $em->getRepository('DGPlusbelleBundle:Descuento')->find($descuentoId);
                $ventaVacuna->setDescuento($descuento);
            }
            
            if(!is_null($observaciones)){
                $ventaVacuna->setObservaciones($observaciones);
            }
            
            $ventaVacuna->setFechaVenta(new \DateTime('now'));
            $ventaVacuna->setEstado(1);
            $ventaVacuna->setMontoTotal(0);
            
            $em->persist($ventaVacuna);
            $em->flush();
            
            $montoTotal = 0;
            $nomvac = array();
            $costovac = array();
            $aplicacionesvac = array();
            
            
            foreach($valores as $key=>$row){
                //var_dump($row);
                $vacunaConsulta = new \DGPlusbelleBundle\Entity\VacunaConsulta();
                $vacuna = $em->getRepository('DGPlusbelleBundle:Vacuna')->find($row[0]);
                $vacunaConsulta->setCosto($row[1]);
                $vacunaConsulta->setConsulta(null);
                $vacunaConsulta->setVacuna($vacuna);
                
                if($descuento){
                    $vacunaConsulta->setDescuento($descuento->getId());
                } else {
                    $vacunaConsulta->setDescuento(0);
                }    
                
                $vacunaConsulta->setVentaVacuna($ventaVacuna);
                $vacunaConsulta->setAplicaciones($row[2]);

                $montoTotal+=$vacunaConsulta->getCosto();
                
                $em->persist($vacunaConsulta);
                $em->flush();
                
                $nomvac[$key]['nombre'] = $vacuna->getNombre();
                $nomvac[$key]['costo'] = $vacunaConsulta->getCosto();
                $nomvac[$key]['aplicaciones'] = $vacunaConsulta->getAplicaciones();
                
                $seguimiento = new \DGPlusbelleBundle\Entity\SeguimientoAplicacionVacuna();
                $seguimiento->setVentaVacuna($ventaVacuna);
                $seguimiento->setVacuna($vacuna);
                $seguimiento->setNumAplicacion(0);
                $em->persist($seguimiento);
                $em->flush();
            }
            
            $ventaVacuna->setMontoTotal($montoTotal);
            $em->merge($ventaVacuna);
            $em->flush();
            
            
            
            if($ventaVacuna->getDescuento()){    
                $totaldesc = ($ventaVacuna->getMontoTotal() * $ventaVacuna->getDescuento()->getPorcentaje()) / 100;
                $porcentaje = $ventaVacuna->getDescuento()->getPorcentaje();
            } else {
                $totaldesc = 0;
                $porcentaje = 0;
            }
            
            $idVenta =$ventaVacuna->getId();
            $rsm2 = new ResultSetMapping();
            $sql2 = "select cast(sum(abo.monto) as decimal(36,2)) abonos, count(abo.monto) cuotas "
                    . "from abono abo inner join venta_vacuna p on abo.venta_vacuna = p.id "
                    . "where p.id = '$idVenta'";
            
            $rsm2->addScalarResult('abonos','abonos');
            $rsm2->addScalarResult('cuotas','cuotas');
            
            $abonos = $em->createNativeQuery($sql2, $rsm2)
                    ->getSingleResult();
            
            $rsm = new ResultSetMapping();
            $ventaid = $ventaVacuna->getId();
            
            $sql = "select ven.id as id,"
                    . "tra.nombre as ntrata, "
                    . "pt.aplicaciones as aplicaciones, "
                    . "seg.num_aplicacion as numAplicacion "
                    . "from venta_vacuna ven "
                    . "inner join seguimiento_aplicacion_vacuna seg on ven.id = seg.venta_vacuna "
                    . "inner join empleado emp on ven.empleado = emp.id "
                    . "inner join paciente pac on ven.paciente = pac.id "
                    . "inner join vacuna_consulta pt on ven.id = pt.venta_vacuna "
                    . "inner join vacuna tra on pt.id_vacuna = tra.id "
                    . "left outer join descuento des on ven.descuento = des.id "
                    . "where ven.id = '$ventaid' and seg.vacuna = pt.id_vacuna";

            $rsm->addScalarResult('id','id');
            $rsm->addScalarResult('ntrata','ntrata');
            $rsm->addScalarResult('aplicaciones','aplicaciones');
            $rsm->addScalarResult('numAplicacion','numAplicacion');

            $mensaje = $em->createNativeQuery($sql, $rsm)
                    ->getResult();
            
            $vacunas = $em->getRepository('DGPlusbelleBundle:VacunaConsulta')->findBy(array('ventaVacuna' => $idVenta));

            $idvacunas = array();      
            foreach ($vacunas as $trat){
                $idvac = $trat->getVacuna()->getId();

                $seguimiento = $em->getRepository('DGPlusbelleBundle:SeguimientoAplicacionVacuna')->findOneBy(array('vacuna' => $trat->getVacuna(),
                                                                                                                    'ventaVacuna' => $ventaVacuna
                                                                                                                ));

                if($seguimiento->getNumAplicacion() < $trat->getAplicaciones()){
                    array_push($idvacunas, $idvac); 
                }            
            }

            $dql = "SELECT t.id, t.nombre FROM DGPlusbelleBundle:Vacuna t "
                        . "WHERE t.id IN (:ids) ";

            $vacunasPaquete = $em->createQuery($dql)
                               ->setParameter('ids', $idvacunas)
                               ->getResult();  
            
            $ventaPaqueteTratamientos = array(
                                        'id' => $ventaVacuna->getId(), 
                                        'costo' => $ventaVacuna->getMontoTotal(), 
                                        'descuento' => $totaldesc, 
                                        'cuotas' => $ventaVacuna->getCuotas(),
                                        'desc' => $ventaVacuna->getDescuento()->getNombre().' - '.$ventaVacuna->getDescuento()->getPorcentaje(),
                                        'observaciones' => $ventaVacuna->getObservaciones()
                                    );
            
            $this->get('bitacora')->escribirbitacora("Se registro una nueva venta de vacunas ", $usuario->getId());
            
            $response = new JsonResponse();
            $response->setData(array(
                                'exito'       => '1',
                                'ventaVacuna' => $ventaVacuna->getId(),
                                'ventasVacuna' => $mensaje,
                                'vacunasPaquete' => $vacunasPaquete,
                                'porcentaje' => $porcentaje,
                                'nomvac' => $nomvac,
                                'abonos' => $abonos,
                                'empleado' => $ventaVacuna->getEmpleado()->getPersona()->getNombres().' '.$ventaVacuna->getEmpleado()->getPersona()->getApellidos(),
                                'ventaVacunas' => $ventaPaqueteTratamientos
                               ));  
            
            return $response; 
        } else {    
            return new Response('0');              
        } 
   }
   
   /**
    * Ajax utilizado para registrar una nueva venta de vacunas
    *  
    * @Route("/registro-vacuna/consulta/nueva-venta/set", name="admin_registro_nueva_venta_vacuna_consulta")
    */
    public function registrarNuevaVentaVacunaConsultaAction()
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();
            $usuario= $this->get('security.token_storage')->getToken()->getUser();
            
            $id = $this->get('request')->request->get('id');
            $empleadoId = $this->get('request')->request->get('empleado');
            $cuotas = $this->get('request')->request->get('cuotas');
            $valores = $this->get('request')->request->get('valores');
            $descuentoId = $this->get('request')->request->get('descuento');
            $observaciones = $this->get('request')->request->get('observaciones');
            $consultaId = $this->get('request')->request->get('consulta');
            
            $ventaVacuna = new VentaVacuna();
            
            $consulta = $em->getRepository('DGPlusbelleBundle:Consulta')->find($consultaId);
            $paciente = $em->getRepository('DGPlusbelleBundle:Paciente')->find($id);
            $ventaVacuna->setPaciente($paciente);
            
            if(!is_null($empleadoId) && $empleadoId != ''){
                $empleado = $em->getRepository('DGPlusbelleBundle:Empleado')->find($empleadoId);
                $ventaVacuna->setEmpleado($empleado);
            }
            
            $ventaVacuna->setCuotas($cuotas);
            
            if(!is_null($descuentoId)){
                $descuento = $em->getRepository('DGPlusbelleBundle:Descuento')->find($descuentoId);
                $ventaVacuna->setDescuento($descuento);
            }
            
            if(!is_null($observaciones)){
                $ventaVacuna->setObservaciones($observaciones);
            }
            
            $ventaVacuna->setFechaVenta(new \DateTime('now'));
            $ventaVacuna->setEstado(1);
            $ventaVacuna->setMontoTotal(0);
            
            $em->persist($ventaVacuna);
            $em->flush();
            
            $montoTotal = 0;
            foreach($valores as $key=>$row){
                $vacuna = $em->getRepository('DGPlusbelleBundle:Vacuna')->find($row[0]);
                
                $vacunaConsulta = $em->getRepository('DGPlusbelleBundle:VacunaConsulta')->findOneBy(array('consulta' => $consulta,
                                                                                                       'vacuna' => $vacuna
                                                                                                       ));

                $vacunaConsulta->setVentaVacuna($ventaVacuna);
                $montoTotal+=$vacunaConsulta->getCosto();
                
                $em->merge($vacunaConsulta);
                $em->flush();
                
                $seguimiento = new \DGPlusbelleBundle\Entity\SeguimientoAplicacionVacuna();
                $seguimiento->setVentaVacuna($ventaVacuna);
                $seguimiento->setVacuna($vacuna);
                $seguimiento->setNumAplicacion(0);
                $em->persist($seguimiento);
                $em->flush();
            }
            
            $ventaVacuna->setMontoTotal($montoTotal);
            $em->merge($ventaVacuna);
            $em->flush();
            
            if($ventaVacuna->getDescuento()){    
                $totaldesc = ($ventaVacuna->getMontoTotal() * $ventaVacuna->getDescuento()->getPorcentaje()) / 100;
                $porcentaje = $ventaVacuna->getDescuento()->getPorcentaje();
            } else {
                $totaldesc = 0;
                $porcentaje = 0;
            }
            
            $idVenta =$ventaVacuna->getId();
            $rsm2 = new ResultSetMapping();
            $sql2 = "select cast(sum(abo.monto) as decimal(36,2)) abonos, count(abo.monto) cuotas "
                    . "from abono abo inner join venta_vacuna p on abo.venta_vacuna = p.id "
                    . "where p.id = '$idVenta'";
            
            $rsm2->addScalarResult('abonos','abonos');
            $rsm2->addScalarResult('cuotas','cuotas');
            
            $abonos = $em->createNativeQuery($sql2, $rsm2)
                    ->getSingleResult();
            
            $rsm = new ResultSetMapping();
            $ventaid = $ventaVacuna->getId();
            
            $sql = "select ven.id as id,"
                    . "tra.nombre as ntrata, "
                    . "pt.aplicaciones as aplicaciones, "
                    . "seg.num_aplicacion as numAplicacion "
                    . "from venta_vacuna ven "
                    . "inner join seguimiento_aplicacion_vacuna seg on ven.id = seg.venta_vacuna "
                    . "inner join empleado emp on ven.empleado = emp.id "
                    . "inner join paciente pac on ven.paciente = pac.id "
                    . "inner join vacuna_consulta pt on ven.id = pt.venta_vacuna "
                    . "inner join vacuna tra on pt.id_vacuna = tra.id "
                    . "left outer join descuento des on ven.descuento = des.id "
                    . "where ven.id = '$ventaid' and seg.vacuna = pt.id_vacuna";

            $rsm->addScalarResult('id','id');
            $rsm->addScalarResult('ntrata','ntrata');
            $rsm->addScalarResult('aplicaciones','aplicaciones');
            $rsm->addScalarResult('numAplicacion','numAplicacion');

            $mensaje = $em->createNativeQuery($sql, $rsm)
                    ->getResult();
            
            $ventaPaqueteTratamientos = array(
                                        'id' => $ventaVacuna->getId(), 
                                        'costo' => $ventaVacuna->getMontoTotal(), 
                                        'descuento' => $totaldesc, 
                                        'cuotas' => $ventaVacuna->getCuotas(),
                                        'observaciones' => $ventaVacuna->getObservaciones()
                                    );
            
            $this->get('bitacora')->escribirbitacora("Se registro una nueva venta de vacunas ", $usuario->getId());
            $vacunas = $em->getRepository('DGPlusbelleBundle:VacunaConsulta')->findBy(array('ventaVacuna' => $ventaid));
            $idvacunas = array();      
            foreach ($vacunas as $trat){
                $idvac = $trat->getVacuna()->getId();

                $seguimiento = $em->getRepository('DGPlusbelleBundle:SeguimientoAplicacionVacuna')->findOneBy(array('vacuna' => $trat->getVacuna(),
                                                                                                                    'ventaVacuna' => $ventaVacuna
                                                                                                                ));

                if($seguimiento->getNumAplicacion() < $trat->getAplicaciones()){
                    array_push($idvacunas, $idvac); 
                }            
            }

            $dql = "SELECT t.id, t.nombre FROM DGPlusbelleBundle:Vacuna t "
                        . "WHERE t.id IN (:ids) ";

            $vacunasPaquete = $em->createQuery($dql)
                               ->setParameter('ids', $idvacunas)
                               ->getResult();  
            
            $response = new JsonResponse();
            $response->setData(array(
                                'exito'       => '1',
                                'ventaVacuna' => $ventaVacuna->getId(),
                                'ventasVacuna' => $mensaje,
                                'porcentaje' => $porcentaje,
                                'abonos' => $abonos,
                                'vacunasPaquete' => $vacunasPaquete,
                                'empleado' => $ventaVacuna->getEmpleado()->getPersona()->getNombres().' '.$ventaVacuna->getEmpleado()->getPersona()->getApellidos(),
                                'ventaVacunas' => $ventaPaqueteTratamientos
                               ));  
            
            return $response; 
        } else {    
            return new Response('0');              
        } 
   }
   
   
   
   
   
   
   
   /**
    * Ajax utilizado para registrar una nueva venta de vacunas
    *  
    * @Route("/registro-medicamento/nueva-venta/set", name="admin_registro_nueva_venta_medicamento")
    */
    public function registrarNuevaVentaMedicamentoAction()
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();
            $usuario= $this->get('security.token_storage')->getToken()->getUser();
            
            $id = $this->get('request')->request->get('id');
            $empleadoId = $this->get('request')->request->get('empleado');
            $cuotas = $this->get('request')->request->get('cuotas');
            //$valores = $this->get('request')->request->get('valores');
            $descuentoId = $this->get('request')->request->get('descuento');
            $observaciones = $this->get('request')->request->get('observaciones');
            $costoMedicamento = $this->get('request')->request->get('costoMedicamento');
            $medicamentos = $this->get('request')->request->get('medicamentos');
            
            
            $medicamento = new Medicamento();
            
            
                       
            
            
            $pacienteObj= $em->getRepository('DGPlusbelleBundle:Paciente')->find($id);
            $empleadoObj= $em->getRepository('DGPlusbelleBundle:Empleado')->find($empleadoId);
            $descuentoObj= $em->getRepository('DGPlusbelleBundle:Descuento')->find($descuentoId);
            
            
            $medicamento->setNombre($medicamentos);
            $medicamento->setEstado(1);
            $medicamento->setEmpleado($empleadoObj);
            
            $medicamento->setDescuento($descuentoObj);
            $medicamento->setCuotas($cuotas);
            
            $medicamento->setObservaciones($observaciones);
            $medicamento->setFechaVenta(new \DateTime('now'));
            $medicamento->setPaciente($pacienteObj);
            $medicamento->setCosto($costoMedicamento);
            
            
            
            //var_dump($medicamento);
            $em->persist($medicamento);
            $em->flush();
            
            
            $response = new JsonResponse();
            $response->setData(array(
                                'exito'       => '0',
                                'medicamento' => $medicamento->getId(),
                                'empleado' => $medicamento->getEmpleado()->getPersona()->getNombres().' '.$medicamento->getEmpleado()->getPersona()->getApellidos(),
                                'descuento'=> $medicamento->getDescuento()->getPorcentaje(),
                                'cuotas'=>$medicamento->getCuotas(),
                                'observaciones'=>$medicamento->getObservaciones(),
                                'nombre'=>$medicamento->getNombre(),
                                'costoMedicamento' => $medicamento->getCosto()
//                                'ventaVacunas' => $ventaPaqueteTratamientos
                               ));  
            
            return $response; 
        } else {    
            return new Response('0');              
        } 
   }
}
