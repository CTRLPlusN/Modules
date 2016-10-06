<?php

namespace CTRLPlusN\Modules\SlideshowModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use CTRLPlusN\Modules\SlideshowModule\Form\SlideType;

class SlideshowType extends AbstractType {

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('id', TextType::class, array('required' => true))
                ->add('slides', CollectionType::class, array(
                    'label' => false,
                    'entry_type' => SlideType::class,
                    'entry_options' => array(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                ))
                ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CTRLPlusN\Modules\SlideshowModule\Model\Slideshow',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form_settings_slideshow';
    }

}
