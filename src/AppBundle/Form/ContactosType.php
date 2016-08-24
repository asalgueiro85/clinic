<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ContactosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('observaciones', 'text', array(
                'attr' => array(
                    'placeholder' => 'Observaciones'
                )
            ))

            ->add('email', 'email', array(
                'label' => 'Correo',
                'attr' => array(
                    'placeholder' => 'Correo'
                )
            ))

            ->add('numero', 'number', array(
                'required' => false
            ))
            ->add('servicio')
            ->add('tipo', 'choice', array(
                'required' => true,
                'choices' => array(
                    '0' => 'Correo',
                    '1' => 'Teléfono',
                    '2' => 'Residencia'
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
            'data_class' => 'AppBundle\Entity\Contactos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clinica_frontbundle_contactos';
    }
}
