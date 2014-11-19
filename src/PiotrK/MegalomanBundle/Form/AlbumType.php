<?php

namespace PiotrK\MegalomanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlbumType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('name', null ,array(
                'label' => 'Nazwa albumu',
                'attr' => array(
                  'class' => "form-control"  
                ),
            ))
            ->add('artists', null ,array(
                'label' => 'Artyści',
                'expanded' => true,
                'multiple' => true,
            ))
    ;
  }

  /**
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'PiotrK\MegalomanBundle\Entity\Album'
    ));
  }

  /**
   * @return string
   */
  public function getName() {
    return 'piotrk_megalomanbundle_album';
  }

}
