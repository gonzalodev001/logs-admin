<?php


namespace LaSalle\GroupSeven\Controller\LogSummary;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/log-summary/dev', name: 'dashboard_summary')]
    public function index(): Response
    {
        return $this->render('LogSummary/index.html.twig', [
            'controller_name' => 'Bienvenido dashboard summary'
        ]);
    }
}