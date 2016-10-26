<?php

namespace CTRLPlusN\Modules\SubscriberModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use CTRLPlusN\Modules\SubscriberModule\Entity\Superclass\Information;

class InformationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('nom', TextType::class)
                ->add('prenom', TextType::class)
                ->add('birthday', TextType::class)
                ->add('rue', TextType::class)
                ->add('cp', TextType::class)
                ->add('ville', TextType::class)
                ->add('email', TextType::class)
                ->add('phone', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Information::class,
        ));
    }

    public function getName() {
        return 'form_informations';
    }

}
