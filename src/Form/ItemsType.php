<?php

namespace App\Form;

use App\Entity\Items;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('categories')
            ->add('description')
            ->add('amount', NumberType::class,[
            'label' => 'quantity',])
            ->add('purchasing_value')
            ->add('sales_value')
            ->add('alertValue')
            ->add('creationDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker']])
            ->add('save', SubmitType::class, [
            'attr' =>['class' => 'save'],
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Items::class,
        ]);
    }
}
