<?php

namespace App\Controller;

use App\Entity\Items;
use App\Entity\Reservation;
use App\Entity\ReservationItem;
use App\Form\ReservationType;
use App\Repository\ItemsRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository,UserRepository $userRepository, ItemsRepository $itemsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
            'users'=> $userRepository->findAll(),
            'item' => $itemsRepository->findAll(),
        ]);
    }

    #[Route('/new.html.twig', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservationRepository $reservationRepository, UserRepository $userRepository, ItemsRepository $itemsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $selectedItems = $form->get('selectedItems')->getData();
//
//            foreach ($selectedItems as $item){
//                $reservationItem = new Items();
//                $reservationItem->setName($item);
//                $reservationItem->setAmount($item);
//                $item->addItems($reservation);
//            }

            $reservation->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($reservation);

            foreach($form->get('ReservationItems')->getData() as $reservationItem){
                $amount = $reservationItem->getAmount();
                $items = $reservationItem->getItems();

                $reservationItemEntity = new ReservationItem();
                $reservationItemEntity->addItem($items);
                $reservationItemEntity->removeItem($items);
                $reservationItemEntity->setAmount($amount);
                $reservationItemEntity->setReservation($reservation);
                $entityManager->persist($reservationItemEntity);

            }

            $entityManager->flush();
            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
            'user'=> $userRepository->findAll(),
            'item' => $itemsRepository,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepository->add($reservation, true);

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $reservationRepository->remove($reservation, true);
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
