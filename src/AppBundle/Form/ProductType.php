<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name', TextType::class, array('label' => 'Name'))
			->add('price', NumberType::class, array('label' => 'Price', 'scale' => 2))
			->add('category',EntityType::class, array(
					'class' => 'AppBundle:Category',
					'choice_label' => 'getName',
					'multiple' => false,
					'label' => 'Category',
				))
			->add('material',EntityType::class, array(
					'class' => 'AppBundle:Material',
					'choice_label' => 'getName',
					'multiple' => false,
					'label' => 'Material',
				))
			->add('quantity', IntegerType::class, array('label' => 'Quantity of material'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}
