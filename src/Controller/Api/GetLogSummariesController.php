<?php

namespace LaSalle\GroupSeven\Controller\Api;

use LaSalle\GroupSeven\LogSummary\Application\GetLogSummariesByEnvironmentAndLevelsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetLogSummariesController extends AbstractController
{
    public function __construct(private GetLogSummariesByEnvironmentAndLevelsUseCase $getLogSummariesByEnvironmentAndLevelsUseCase, private SerializerInterface $serializer)
    {

    }

    #[Route('/{environment}/log-summaries', methods: ['GET'])]
    public function __invoke(string $environment, Request $request): JsonResponse
    {
        $levels = null;
        if( !empty($request->query->get('filter')['level']) ) {
            $levels = explode(',',$request->query->get('filter')['level']);
        }
        try {
            $logSummaries = $this->getLogSummariesByEnvironmentAndLevelsUseCase->__invoke($environment, $levels);
            $jsonContent = $this->serializer->serialize($logSummaries, 'json');
            return new JsonResponse($jsonContent, Response::HTTP_OK);
        }catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

}