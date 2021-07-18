<?php


namespace LaSalle\GroupSeven\Controller\LogSummary;


use LaSalle\GroupSeven\LogSummary\Application\GetLogSummariesByEnvironmentAndLevelsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogSummaryController extends AbstractController
{

    public function __construct(private GetLogSummariesByEnvironmentAndLevelsUseCase $repository)
    {
    }

    #[Route('/log-summary/{environment}', name: 'dashboard_summary')]
    public function index(string $environment): Response
    {
        $logSummaries = $this->repository->__invoke($environment);
        return $this->render('LogSummary/index.html.twig', [
            'log_summaries' => $logSummaries
        ]);
    }
}