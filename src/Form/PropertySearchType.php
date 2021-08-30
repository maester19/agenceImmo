<?php

namespace App\Form;

use App\Entity\Propertysearch;
use App\Entity\Option;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                "required" => false,
                "label" =>false,
                'attr' => [
                    'placeholder' => 'Budget max'
                ] 
            ])
            ->add('minSurface', IntegerType::class, [
                "required" => false,
                "label" =>false,
                'attr' => [
                    'placeholder' => 'surface minimun'
                ] 
            ])
            ->add('options', EntityType::class , [
                'required' => false,
                'label' => false,
                'class'=> Option::class,
                'choice_label'=> 'name',
                'multiple' => true,
                'attr' => [
                    'class' => 'select2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Propertysearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
