<?php

namespace CTRLPlusN\Libs\ReviewManagement\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Router;

class ResearchType extends AbstractType {

    protected $router;

    public function __construct(Router $router) {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->setAction($this->router->generate('post_research_index'))
                ->add('string', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }

    public function getName() {
        return 'form_research';
    }

}
