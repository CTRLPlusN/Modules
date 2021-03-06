<?php

namespace CTRLPlusN\Modules\ReviewModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use CTRLPlusN\Modules\ReviewModule\Entity\Category;

class CategoryType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $entity = $builder->getData();
        $builder
                ->add('title', TextType::class)
                ->add('parent', EntityType::class, array(
                    'class' => 'Review:Category',
                    'choice_label' => 'title',
                    'required' => false,
                    'placeholder' => 'Aucune',
                    'empty_data' => null,
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($entity) {
                        return $er->selectMainCategories($entity); // Return QueryBuilder (not Array)
                    }));
                    if(method_exists($entity, 'getDescription')) {
                        $builder->add('description',TextareaType::class, array('required' => false));
                    }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Category::class,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form_category';
    }

}
