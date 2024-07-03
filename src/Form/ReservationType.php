<?php

namespace App\Form;

use App\Entity\Items;
use App\Entity\Reservation;
use App\Entity\ReservationItem;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use App\Repository\ItemsRepository;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment', TextareaType::class, [
                'label' => 'Comment:',
                ])
            ->add('creationTime', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker']
                ])
            ->add('lastUpdate', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker']
                ])
            ->add('status' , ChoiceType::class, [
                'label' => 'Status:',
                'choices' => [
                    'Ready' => 'Ready',
                    'Preparing' => 'Preparing',
                    'send' => 'send'],
                ])
            ->add('user', EntityType::class,[
                'mapped' => false,
                'class' => User::class,
                ])
            ->add('items', EntityType::class,[
                'class' => Items::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
//                'class' => Items::class,
//            ->add('amount', EntityType::class, [
//        'label' => 'Quantity',])
//        ->add('reservationItems', CollectionType::class, [
//            'entry_type' => ItemsReservationType::class,
//            'allow_add' => true,
//            'by_reference' => false,
//        ])
//            ->add('reservationItems', CollectionType::class, [
//                'entry_type' => ReservationItemType::class,
//                'allow_add' => true,
//                'allow_delete' => true,
//                'by_reference' => false,
//            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
    private Security $security;

//    private $itemsRepository;
    public function __construct(Security $security)
    {
        $this->security = $security;
        $user = $this->security->getUser();
//        $this->itemsRepository = $itemsRepository;
    }

//    private function getChoicesFromItems(): array
//    {
//       $items = $this->itemsRepository;
//       $choices = [];
//       foreach($items as $item){
//           $choices[$item->getName()]= $item->getId() ;
//       }
//       return $choices;
//    }

}
