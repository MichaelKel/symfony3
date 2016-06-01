<?php

namespace LazyBlog\LazyModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserType
 */
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
//            ->add('email')
//            ->add('password')
//            ->add('role')
//            ->add('slug')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LazyBlog\LazyModelBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'lazyblog_lazymodelbundle_user';
    }
}
