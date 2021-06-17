<?php

namespace LaSalle\GroupSeven\Controller;

use LaSalle\GroupSeven\LogSummary\Application\GetLogSummariesByEnvironmentAndLevelsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LogSummaryEnvLevelController extends AbstractController
{
    public function __construct(private GetLogSummariesByEnvironmentAndLevelsUseCase $getLogSummariesByEnvironmentAndLevelsUseCase)
    {
    }

    #[Route('/summary/{environment}/{level}', name: 'LogSummaryEnvLevels', methods: ['GET'])]
    public function index(string $environment, string $level): Response
    {
        $levels[] = $level;
        try {
            $logSummaries = $this->getLogSummariesByEnvironmentAndLevelsUseCase->__invoke($environment, $levels);

            return $this->render('LogSummary/LogSummaryEnvLevel.html.twig', ['environment' => $environment, 'level' => $level, 'logSummaries' => $logSummaries]);
        }catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}