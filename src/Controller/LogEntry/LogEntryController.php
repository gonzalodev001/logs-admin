<?php


namespace LaSalle\GroupSeven\Controller\LogEntry;


use LaSalle\GroupSeven\Log\Application\AllLogEntriesByEnvironmentUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;

class LogEntryController extends AbstractController
{
    private int $currentPage =1;

    public function __construct(private AllLogEntriesByEnvironmentUseCase $allLogEntriesByEnvironmentUseCase)
    {
    }

    #[Route('/log-entry/{environment}', name: 'list_log_entry', methods: ['GET'])]
    public function allEntries(string $environment, Request $request): Response
    {
        $currentPage = $request->get('currentPage');
        if(is_null($currentPage)) {
            $currentPage = 1;
        }
        $em = $this->getDoctrine()->getManager();
        $limit = $request->get('limit');
        if(is_null($limit)) {
            $limit = 10;
        }

        $logEntries = $this->allLogEntriesByEnvironmentUseCase->__invoke($environment, $currentPage, $limit);

        /**@var Paginator $paginator*/
        $paginator = $logEntries['paginator'];
        $logEntriesResult = $logEntries['paginator'];
        $logEntriesQuery = $logEntries['query'];
        $logEntriesLimitPaginate = $logEntries['limit'];
        $maxPages = ceil($paginator->count() / $logEntriesLimitPaginate);

        return $this->render('LogEntry/log_entries.html.twig',[
            'log_entries' => $logEntriesResult,
            'max_pages' => $maxPages,
            'this_page' => $currentPage,
            'all_items' => $logEntriesQuery,
            'environment' => $environment,
            'limit_paginate' => $logEntriesLimitPaginate
        ]);
    }
}