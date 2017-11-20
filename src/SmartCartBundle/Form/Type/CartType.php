<?php
namespace SmartCartBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use SmartCartBundle\Form\DataTransformer\StringToProductTransformer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SmartCartBundle\Entity\Cart;
use SmartCartBundle\Entity\Category;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['entity_manager'];

        $builder
        ->add('name', TextType::class)
        ->add('description', TextType::class)
        ->add('quantity', IntegerType::class)
        ->add('price', IntegerType::class)
        ->add('image', UrlType::class)
        ->add('associated_cart', EntityType::class, array('class' => 'SmartCartBundle:Cart','empty_data' => '', 'required' => false))
        ->add('products', CollectionType::class, array(
            'entry_type' => ProductType::class
        ))
        ->add('category', EntityType::class, array(
            'class' => Category::class
        ))
        ->add('save', SubmitType::class, array('label' => 'Sauvegarder'));
/*
        $builder
        ->get('products')->addModelTransformer(new StringToProductTransformer($em));*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('entity_manager');
        $resolver->setDefaults(array(
            'data_class' => Cart::class,
        ));
    }
}
