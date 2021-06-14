<?php

namespace LaSalle\GroupSeven\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetLogSummariesController extends AbstractController
{
    #[Route('/log-summaries', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return new Response(
            '<html><body>hola</body></html>'
        );
    }
}