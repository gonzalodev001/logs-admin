<?php

namespace LaSalle\GroupSeven\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function hello(LoggerInterface $logger, Request $request): Response
    {
        $logger->info('I just got the logger', ['env' => $_ENV['APP_ENV'], 'env_alias' => $_ENV['APP_ENV_ALIAS']]);
        $logger->warning('A warning occurred', ['env' => $_ENV['APP_ENV'], 'env_alias' => $_ENV['APP_ENV_ALIAS']]);

        $logError = $request->query->getBoolean('logError');
        if ($logError) {
            $logger->error('A error occurred', ['env' => $_ENV['APP_ENV'], 'env_alias' => $_ENV['APP_ENV_ALIAS']]);
        }

        return new Response(
            '<html><body>Hello World! from '.$_ENV['APP_ENV'].' => '.$_ENV['APP_ENV_ALIAS'].'</body></html>'
        );
    }
}