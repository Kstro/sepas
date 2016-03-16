<?php

namespace DGPlusbelleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IncapacidadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaInicial', null,
                  array('label'  => 'Fecha inicial','required'=>false,
                        'widget' => 'single_text',
                        'attr'   => array('class' => 'form-control input-sm fechaInicial'),
                        'format' => 'dd-MM-yyyy',
                       ))
            ->add('fechaFinal', null,
                  array('label'  => 'Fecha final','required'=>false,
                        'widget' => 'single_text',
                        'attr'   => array('class' => 'form-control input-sm fechaFinal'),
                        'format' => 'dd-MM-yyyy',
                       ))
            ->add('notas','textarea',array('label'=>'Notas/Observaciones'))
            ->add('paciente','entity', array( 'label' => 'Paciente','required'=>false,
                     'empty_value'   => 'Seleccione un paciente...',
                     'class'         => 'DGPlusbelleBundle:Paciente',
                     'attr'=>array(
                     'class'=>'form-control input-sm pacienteConsulta'
                     )
                   ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DGPlusbelleBundle\Entity\Incapacidad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dgplusbellebundle_incapacidad';
    }
}
