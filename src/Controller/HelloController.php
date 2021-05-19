<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function hello(): Response
    {
        return new Response(
            '<html><body>Hello World! from '.$_ENV['APP_ENV'].' => '.$_ENV['APP_ENV_ALIAS'].'</body></html>'
        );
    }
}