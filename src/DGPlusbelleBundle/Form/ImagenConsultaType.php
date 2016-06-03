<?php

namespace DGPlusbelleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImagenConsultaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('foto')
            //->add('consulta')
            ->add('file',null, array('label'=>'Documento escaneado','required'=>false,
                    'attr'=>array('class'=>'foto'  
                        
                    )))  
            ->add('observaciones',null, array('label'=>'Observaciones','required'=>false,
                    'attr'=>array('class'=>'foto'  
                        
                    )))  
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DGPlusbelleBundle\Entity\ImagenConsulta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dgplusbellebundle_imagenconsulta';
    }
}
