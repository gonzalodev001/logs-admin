<?php

namespace LaSalle\GroupSeven\Core\Domain\Logger;

use Monolog\Processor\ProcessorInterface;
use Symfony\Component\Uid\Uuid;

class CustomProcessor implements ProcessorInterface
{
    public function __invoke(array $record): array
    {
        $uuid = Uuid::v4();
        $id = $uuid->toRfc4122();
        $record['extra']['uuid'] = $id;
        $record['extra']['env'] ='dev'; // $_ENV['APP_ENV'];
        $record['extra']['env_alias'] = $_ENV['APP_ENV_ALIAS'];
        return $record;
    }
}