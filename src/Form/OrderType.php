<?php

namespace App\Form;

use App\Entity\Delivery;
use App\Entity\Order\Order;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('phone')
            ->add('nip')
            ->add('companyName')
            ->add('street')
            ->add('city')
            ->add('buildingNumber')
            ->add('localNumber')
            ->add('postCode')
            ->add('delivery', EntityType::class, [
                'class' => Delivery::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
