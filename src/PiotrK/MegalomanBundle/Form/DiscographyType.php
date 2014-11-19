<?php

namespace PiotrK\MegalomanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiscographyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('owner')
            ->add('albums', null, array(
                'label' => 'Albumy',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
                ))
        ;
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PiotrK\MegalomanBundle\Entity\Discography'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'piotrk_megalomanbundle_discography';
    }
}
