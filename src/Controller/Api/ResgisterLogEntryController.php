<?php


namespace LaSalle\GroupSeven\Controller\Api;


use LaSalle\GroupSeven\Log\Application\CreateLogEntryUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResgisterLogEntryController
{

    public function __construct(private CreateLogEntryUseCase $createLogEntryUseCase)
    {
    }

    #[Route('/log-entries', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->createLogEntryUseCase->__invoke(
                $request->request->get('id'),
                $request->request->get('environment'),
                strtoupper($request->request->get('level')),
                $request->request->get('message'),
                $request->request->get('occurredOn')
            );
            return new JsonResponse('Ok', Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}