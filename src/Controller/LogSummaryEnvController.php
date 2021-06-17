<?php

namespace LaSalle\GroupSeven\Controller;

use LaSalle\GroupSeven\LogSummary\Application\GetLogSummariesByEnvironmentAndLevelsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LogSummaryEnvController extends AbstractController
{
    public function __construct(private GetLogSummariesByEnvironmentAndLevelsUseCase $getLogSummariesByEnvironmentAndLevelsUseCase)
    {
    }

    #[Route('/summary/{environment}', name: 'LogSummaryEnv', methods: ['GET'])]
    public function index(string $environment): Response
    {
        try {
            $logSummaries = $this->getLogSummariesByEnvironmentAndLevelsUseCase->__invoke($environment);

            return $this->render('LogSummary/LogSummaryEnv.html.twig', ['environment' => $environment, 'logSummaries' => $logSummaries]);
        }catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}