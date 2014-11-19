<?php

namespace PiotrK\MegalomanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtistType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('name', null, array(
                'label' => "Imię:",
                'attr' => array(
                  'class' => "form-control"  
                ),
            ))
            ->add('lastName', null, array(
                'label' => "Nazwisko:",
                'attr' => array(
                  'class' => "form-control"  
                ),
            ))
    ;
  }

  /**
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setDefaults(array(
        'data_class' => 'PiotrK\MegalomanBundle\Entity\Artist'
    ));
  }

  /**
   * @return string
   */
  public function getName() {
    return 'piotrk_megalomanbundle_artist';
  }

}
