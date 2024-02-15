<?php

namespace App\Controller;

use App\Repository\ItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    #[Route('/main/index.html.twig', name: 'app_main_index')]
    public function index(ItemsRepository $itemsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $items = $itemsRepository->findAll();
        $totalPurchasingValue = $this->calcTotalPValue($items);
        $tSalesValue = $this->calcTotalSValue($items);
        $date = date('d/m/Y');
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'items' => $items,
            'totalPurchasingValue' => $totalPurchasingValue,
            'totalSalesValue' => $tSalesValue,
            'date' => $date,
        ]);
    }

    public function calcTotalPValue($items): float
    {
        $totalPurchasingValue = 0;

        foreach ($items as $item){
            $totalPurchasingValue += $item->getPurchasingValue() * $item->getAmount();
        }
        return $totalPurchasingValue;
    }

    public function calcTotalSValue($items): float
    {
        $totalSalesValue = 0;

        foreach ($items as $item){
            $totalSalesValue += $item->getSalesValue() * $item->getAmount();
        }
        return $totalSalesValue;
    }

}
