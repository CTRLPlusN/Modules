<?php

namespace CTRLPlusN\Libs\ReviewManagement\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Doctrine\Common\Persistence\ObjectManager;
use CTRLPlusN\Components\Extras\DataTransformer\NumberIdTransformer;
use CTRLPlusN\Libs\ReviewManagement\Entity\Post;

class PostType extends AbstractType {

    protected $em;
    protected $user;
    protected $categories = array();

    public function __construct(ObjectManager $em) {
        $this->em = $em;
        $this->sortedCategories('Review:Category');
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        // Get Current User
        $this->user = $options['current_user'];

        // Get Post Entity data;
        $post = $builder->getData();

        // Define if Author exist or not, if not set current user
        if (null === $post->getAuthor()) {
            $current = $this->user;
        } else {
            $current = $post->getAuthor();
        }

        $builder
                ->add('title', TextType::class)
                ->add('content', CKEditorType::class, array())
                ->add('published', ChoiceType::class, array(
                    'choices' => array('Publié' => true, 'En attente' => false)
                ))
                ->add('category', ChoiceType::class, array(
                    'choices' => $this->categories
                ))
                ->add('author', EntityType::class, array(
                    'class' => get_class($this->user),
                    'choice_label' => 'username',
                    'data' => $current,
                    'mapped' => true,
                    'expanded' => false,
                    'multiple' => false,
                    'empty_data' => null,
                    'required' => false,
                ))
                ->add('image', ElFinderType::class, array('instance' => 'form', 'enable' => true))
        ;
        // DataTransformer
        $builder->get('category')
                ->addModelTransformer(new NumberIdTransformer($this->em, 'Review:Category'));
    }

    protected function sortedCategories($class) {
        $categories = $this->em->getRepository($class)->findAllAssociations();
        foreach ($categories as $cat) {
            if ($cat->getParent() === null) {
                $this->categories[$cat->getTitle()] = $cat->getId();
                foreach ($cat->getChildren() as $child) {
                    $this->categories['- - ' . ucfirst($child->getTitle())] = $child->getId();
                }
            }
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Post::class,
            'current_user' => null
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form_post';
    }

}
