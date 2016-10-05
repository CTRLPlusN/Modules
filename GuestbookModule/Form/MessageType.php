<?php

namespace CTRLPlusN\Modules\GuestbookModule\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use CTRLPlusN\Modules\GuestbookModule\Entity\Message;

class MessageType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('author', TextType::class)
                ->add('content', TextareaType::class)
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Message::class,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form_guestbook_message';
    }

}
