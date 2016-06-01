<?php

namespace LazyBlog\LazyModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     *  {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName', TextType::class, array('label' => 'name'))
            ->add('body', TextType::class, array('label' => 'comment.singular'))
            ->add('send', SubmitType::class, array('label' => 'send'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LazyBlog\LazyModelBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public  function getName()
    {
        return 'lazyblog_lazyblog_comment';
    }
}
