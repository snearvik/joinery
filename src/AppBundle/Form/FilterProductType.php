<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FilterProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('category',EntityType::class, array(
					'class' => 'AppBundle:Category',
					'choice_label' => 'getName',
					'multiple' => false,
					'label' => 'Category'))
			->add('minPrice', NumberType::class, array('label' => 'minPrice', 'scale' => 2))
			->add('maxPrice', NumberType::class, array('label' => 'maxPrice', 'scale' => 2))
			->add('existence', CheckboxType::class, array('label' => 'Existence', 'required' => false));
    }

}
