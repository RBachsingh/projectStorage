<?php

namespace App\Form;

use App\Entity\Items;
use App\Entity\ReservationItem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', IntegerType::class)
            ->add('itemId')
            ->add('items', EntityType::class,[
                'class' => Items::class,
                'choice_label' => 'name',
            ])
//            ->add('reservation')
//            ->add('reservations')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationItem::class,
        ]);
    }
}
