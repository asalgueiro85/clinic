<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contactos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ClienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array(
                'label' => 'Nombres',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('apellidos', 'text', array(
                'label' => 'Apellidos',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('sexo', 'choice', array(
                'choices' => array(
                    '0' => 'Masculino',
                    '1' => 'Femenino'
                )
            ))
            ->add('nacionalidad', null, array(
                'label' => 'Nacionalidad',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('tipoIdentificacion', 'entity', array(
                'label' => 'Tipo de Identificación',
                'required' => true,
                'class' => 'AppBundle:tipoIdentificacion',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->where('e.estado =1');
                },
            ))
            ->add('identficacion', null, array(
                'required' => false,
                'label' => 'Nro de Identificación',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('tipoCliente', 'choice', array(
                'label' => 'Tipo de Cliente',
                'choices' => array(
                    '0' => 'Persona Natural',
                    '1' => 'Persona Jurídica'
                )
            ))
            ->add('fechaNacimiento', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'required' => false,
                'read_only' => true,
                'attr' => array(
                    'placeholder' => 'Fecha de nacimiento',
                    'class' => 'form-control'
                )
            ))
            ->add('referencia', 'entity', array(
                'label' => '¿Cómo nos conoció?',
                'required' => true,
                'class' => 'AppBundle:Referencia',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->where('e.mostrar =1');
                },
            ))
            ->add('observaciones', 'textarea', array(
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('direccion', new DireccionType(), array(

                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('contactos', 'collection', array(

                'type' => new ContactosType(),
                'required' => true,
                'label' => 'Contactos',
                'by_reference' => false,
                'prototype' => new Contactos(),
                'allow_delete' => true,
                'allow_add' => true
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clinica_frontbundle_cliente';
    }
}
