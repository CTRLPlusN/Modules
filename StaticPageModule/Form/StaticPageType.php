<?php

namespace CTRLPlusN\Modules\StaticPageModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityRepository;

class PageType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title', TextType::class)
                ->add('ref', TextType::class)
                ->add('view', TextType::class)
                ->add('excerpt', TextareaType::class, array('required' => false))
                ->add('image', ElFinderType::class, array('instance' => 'form', 'enable' => true, 'required' => false))
        ;

        // formEvent pour définir les catégories à afficher dans la liste de choix.
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $node = $event->getData();
            $form = $event->getForm();
            if ($node) {
                $form
                        ->add('parent', EntityType::class, array(
                            'class' => 'CTRLPlusN\Modules\StaticPageModule\Entity\Page',
                            'choice_label' => 'title',
                            'required' => false,
                            'placeholder' => 'Aucune',
                            'empty_data' => null,
                            'query_builder' => function(EntityRepository $er) use ($node) {
                                return $er->findAllItemsAvaibles($node); // Return QueryBuilder (not Array)
                            }
                ));
            }
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CTRLPlusN\Modules\StaticPageModule\Entity\Page',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form_static_page';
    }

}
