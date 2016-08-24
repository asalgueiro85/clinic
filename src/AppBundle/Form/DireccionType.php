<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DireccionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('direccion', 'text', array(
                'label' => 'Dirección',
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control'
                )
            ))
            ->add('referencia', 'text', array(
                'required' => false,
                'label' => 'Referencia',
                'attr'=>array(
                    'class'=>'form-control'
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
            'data_class' => 'AppBundle\Entity\Direccion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clinica_frontbundle_direccion';
    }
}
