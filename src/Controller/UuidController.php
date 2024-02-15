<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Factory\UuidFactory;
use Symfony\Component\Uid\Uuid;

class UuidController extends AbstractController

{
    #[Route('/uuid', name: 'app_uuid')]
    public function index(): Response
    {
        $uuid = Uuid::v1();
        $uuid = Uuid::fromString('d9e7a184-5d5b-11ea-a62a-3499710062d0');

        return $this->render('uuid/index.html.twig', [
            'controller_name' => 'UuidController',
        ]);
    }


    private UuidFactory $uuidFactory;
    public function __construct(UuidFactory $uuidFactory)
    {
        $this->uuidFactory=$uuidFactory;
    }

    public function generate(): void
    {
        $uuid = $this->uuidFactory->create();
        $nameBasedUuid = $this->uuidFactory->nameBased();
    }
}
