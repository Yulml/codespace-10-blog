<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntradaController extends AbstractController
{
    /**
     * @Route("/api/entrada", name="app_api_entrada")
     */
    public function index(): Response
    {
        return $this->render('api/entrada/index.html.twig', [
            'controller_name' => 'EntradaController',
        ]);
    }
}
