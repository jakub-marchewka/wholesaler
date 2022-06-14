<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductVat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('price')
            ->add('priceOld')
            ->add('stock')
            ->add('weight')
            ->add('active', CheckboxType::class, [
                'required' => false
            ])
            ->add('category', EntityType::class, [
                'class' => ProductCategory::class,
                'choice_label' => 'name'
            ])
            ->add('vat', EntityType::class, [
                'class' => ProductVat::class,
                'choice_label' => 'value'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
