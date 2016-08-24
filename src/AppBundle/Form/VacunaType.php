<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VacunaType extends AbstractType
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
            ->add('caduca', 'text', array(
                'label'=>'Caduca',
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Días en los que caduca'
                )
            ))
            ->add('descripcion', 'textarea', array(
                'label'=>'Descripción',
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Descripción'
                )
            ))
            ->add('estado', 'checkbox', array(
                'label'=>'Activa',
                'required'=>false

            ))


//            ->add('mascotas')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Vacuna'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clinica_frontbundle_vacuna';
    }
}
