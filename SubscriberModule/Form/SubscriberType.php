<?php

namespace CTRLPlusN\Modules\SubscriberModule\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use CTRLPlusN\Modules\SubscriberModule\Entity\Subscriber;

class SubscriberType extends InformationType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder, $options);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Subscriber::class
        ));
    }
    
    public function getName() {
        return 'form_subscriber';
    }

}
