<?php
namespace SmartCartBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class)
        ->add('email', EmailType::class)
        ->add('password' , PasswordType::class)
        ->add('enabled', CheckboxType::class, array('required' => false))
        ->add('admin', CheckboxType::class, array('required' => false, 'mapped' => false))
        ->add('save', SubmitType::class, array('label' => 'Sauvegarder'));
    }
}
