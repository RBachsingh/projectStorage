<?php

namespace App\Controller;

use App\Entity\Items;
use App\Form\ItemsType;
use App\Repository\ItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/items')]
class ItemsController extends AbstractController
{
    #[Route('/', name: 'app_items_index', methods: ['GET', 'POST'])]
    public function index(ItemsRepository $itemsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('items/index.html.twig', [
            'items' => $itemsRepository->findAll(),

        ]);

    }

    #[Route('/new', name: 'app_items_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ItemsRepository $itemsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $item = new Items();
        $item->setCreationDate(new \DateTime());
        dump($item->getCreationDate());
        $form = $this->createForm(ItemsType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $itemsRepository->add($item, true);
            $this->addFlash('success' , 'item has been added to the database!');
            return $this->redirectToRoute('app_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('items/new.html.twig', [
            'item' => $item,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_items_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Items $item, ItemsRepository $itemsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(ItemsType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $itemsRepository->add($item, true);

            return $this->redirectToRoute('app_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('items/edit.html.twig', [
            'item' => $item,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_items_delete', methods: ['POST'])]
    public function delete(Request $request, Items $item, ItemsRepository $itemsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->isCsrfTokenValid('delete'.$item->getId(), $request->request->get('_token'))) {
            $itemsRepository->remove($item, true);
        }

        return $this->redirectToRoute('app_items_index', [], Response::HTTP_SEE_OTHER);
    }
}
