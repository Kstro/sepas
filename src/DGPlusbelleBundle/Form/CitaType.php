<?php

namespace DGPlusbelleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DGPlusbelleBundle\Entity\Empleado;
use DGPlusbelleBundle\Entity\Tratamiento;
use DGPlusbelleBundle\Entity\Descuento;
use Doctrine\ORM\EntityRepository;

class CitaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaCita', null,
                  array('label'  => 'Fecha cita','required'=>false,
                        'widget' => 'single_text',
                        'attr'   => array('class' => 'form-control input-sm fechaCita'),
                        'format' => 'dd-MM-yyyy',
                       ))
            /*->add('horaCita', null,
                  array('label'  => 'Hora cita',
                        'attr'   => array('class' => 'input-sm hora'),
                       ))*/
                ->add('horaCita', 'time', array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'hours'=> array('6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
                    'minutes'=> array('0','30')
                ))
->add('horaFin', 'time', array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'hours'=> array('6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
                    'minutes'=> array('0','30')
                ))
           // ->add('fechaRegistro')
            //->add('estado')
            
            ->add('empleado','entity', array( 'label' => 'Empleado','required'=>false,
                         'empty_value'   => 'Seleccione un empleado...',
                         'class'         => 'DGPlusbelleBundle:Empleado',
                        /* 'query_builder' => function(EntityRepository $r){
                                                return $r->createQueryBuilder('emp')
                                                        ->innerJoin('emp.horario', 'h');
                                                //return $r->seleccionarEmpleadosPersonasActivos();
                                            }, */
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerEmpActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))
            /*->add('horario', null, 
                  array( 'label'         => 'Horario',
                         'empty_value'   => 'Seleccione un día...',
                         'attr'=>array(
                         'class'=>'form-control'
                         )
                       ))*/
            ->add('paciente', null, 
                  array( 'label'         => 'Paciente',
                         'empty_value'   => 'Seleccione un paciente...',
                         'class'         => 'DGPlusbelleBundle:Paciente',
                         'attr'=>array(
                         'class'=>'form-control input-sm pacienteCita'
                         )
                       ))
            ->add('tratamiento','entity', array( 'label' => 'Tratamiento','required'=>false,
                         'empty_value'   => 'Seleccione un tratamiento...',
                         'class'         => 'DGPlusbelleBundle:Tratamiento',
                         'query_builder' => function(EntityRepository $repository) {
                            return $repository->obtenerTratActivo();
                       },     
                         'attr'=>array(
                         'class'=>'form-control input-sm tratamientoCita'
                         )
                       ))
            ->add('sucursal',null,array('label' => 'Sucursal','required'=>false,'empty_value'=>'Seleccione Sucursal...',
                    'attr'=>array(
                    'class'=>'form-control input-sm sucursalEmpleado'
                    )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DGPlusbelleBundle\Entity\Cita'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dgplusbellebundle_cita';
    }
}
