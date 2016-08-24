<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TipoIdentificacionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array(
                'label'=>'Nombre',
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Nombre'
                )
            ))
            ->add('descripcion', 'textarea', array(
                'label'=>'Descripción',
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Descripción'
                )
            ))
//            ->add('estado','checkbox', array(
//                'required' => false,
//                'label'=>'Activo',
//                'attr' => array(
//                    'class' => 'flat-red'
//                )
//            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TipoIdentificacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_tipoidentificacion';
    }
}
