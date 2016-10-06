<?php

namespace CTRLPlusN\Modules\SlideshowModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FM\ElfinderBundle\Form\Type\ElFinderType;

class SlideType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('relativePath', ElFinderType::class, array('instance' => 'form', 'enable' => true))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CTRLPlusN\Modules\SlideshowModule\Model\Slide',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form_settings_slide';
    }

}
