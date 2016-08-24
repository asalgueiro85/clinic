<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class RazaType extends AbstractType
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
            ->add('especie', 'entity', array(
                'label'=>'Especie',
                'class' => 'AppBundle:Especie',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->where('e.estado =1')
                        ;
                },
            ))

//            ->add('especie', 'entity', array(
//                'class' => 'AppBundle:Especie',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('p')
//                        ->innerJoin('p.admin', 'u')
//                        ->where('u.username =:admin')
//                        ->setParameter("admin", $this->usuario->getUsername());
//                },
//            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Raza'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_raza';
    }
}
