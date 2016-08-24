<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PelajeType extends AbstractType
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
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pelaje'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_pelaje';
    }
}
