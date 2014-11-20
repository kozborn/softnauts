<?php

namespace PiotrK\MegalomanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('album', 'text' ,array(
                'label' => false,
                'attr' => array(
                  'placeholder' => "szukaj po nazwie albumu",
                  'class' => "form-control"
                ),
            ))
            ->add('artist', 'text' ,array(
                'label' => false,
                'attr' => array (
                'placeholder' => "szukaj po artyście",
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
        'data_class' => null
    ));
  }

  /**
   * @return string
   */
  public function getName() {
    return '';
  }

}
