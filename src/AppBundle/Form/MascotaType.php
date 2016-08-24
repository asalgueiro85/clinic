<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MascotaType extends AbstractType
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
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Nombre'
                )
            ))
            ->add('sexo', 'choice', array(
                'label'=>'Sexo',
                'choices'=>array(
                    '0'=>'Macho',
                    '1'=>'Hembra',
                    '2'=>'Desconocido'
                )

            ))
            ->add('esterilizacion', 'choice',array(
                'label'=>'Esterilización',
                'choices'=>array(
                    '0'=>'Castrado',
                    '1'=>'Desconocido'
                )
            ))
            ->add('fechaNacimiento','date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'read_only' => true,
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Fecha de nacimiento',
                    'class' => 'form-control'
                )
            ))
            ->add('estadoMascota', 'choice',array(
                'label'=>'Estado',
                'choices'=>array(
                    '0'=>'Vivo',
                    '1'=>'Muerto',
                    '2'=>'Hospitalizado'
                )
            ))
            ->add('pedigri', 'choice', array(
                'label'=>'Pedigrí',
                'required' => false,
                'choices'=>array(
                    '0'=>'Seleccione una Opción',
                    '1'=>'Si',
                    '2'=>'No'
                )
            ))
            ->add('numPedigri', 'integer', array(
                'label'=>'Número de pedigrí',
                'required' => false,
                'attr'=>array(
                     'class'=>'form-control',
                    'placeholder'=>'# de pedigrí'
                 )
            ))
            ->add('chip', null, array(
                'label'=>'Chip',
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Chip'
                )
                ))
            ->add('caracter', 'choice', array(
                'label'=>'Caracter',
                'choices'=>array(
                    'empty'=>'Seleccione una Opción',
                    'docil'=>'Dócil',
                    'manso'=>'Manso',
                    'agresivo'=>'Agresivo',
                )
            ))
            ->add('dieta',null, array(
                'label'=>'Dieta',
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Dieta'
                )
            ))
            ->add('observaciones', 'textarea', array(
                'label'=>'Observaciones',
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'Observaciones'
                )
            ))
            ->add('pelaje', 'entity', array(
                'label'=>'Pelaje',
                'required' => true,
                'class' => 'AppBundle:Pelaje',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->where('e.estado =1')
                        ;
                },
            ))
            ->add('raza', 'entity', array(
                'label'=>'Raza',
                'required' => true,
                'class' => 'AppBundle:Raza',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->where('e.estado =1')
                        ;
                },
            ))
            ->add('foto', 'file', array(
                'required' => false,
                'invalid_message' => 'No se admite imágenes mayores a 1MB',
            ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mascota'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_mascota';
    }
}
