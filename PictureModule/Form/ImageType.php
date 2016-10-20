<?php

namespace CTRLPlusN\Modules\PictureModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ImageType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title', TextType::class, array('required' => false))
                ->add('mkdatetime', DateType::class, array('required' => false))
                ->add('location', TextType::class, array('required' => false))
                ->add('description', TextareaType::class, array('required' => false))
                ->add('relativePath', ElFinderType::class, array('instance' => 'form', 'enable' => true))
                ->add('album', EntityType::class, array(
                    'class' => 'Picture:Album',
                    'choice_label' => 'title',
                    'required' => false,
                    'placeholder' => 'Aucune',
                    'empty_data' => null,)
                )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CTRLPlusN\Modules\PictureModule\Entity\Image',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form_image';
    }

}
