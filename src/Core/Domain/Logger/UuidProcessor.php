<?php

namespace LaSalle\GroupSeven\Core\Domain\Logger;

use Monolog\Processor\ProcessorInterface;
use Symfony\Component\Uid\Uuid;

class UuidProcessor implements ProcessorInterface
{
    public function __invoke(array $record): array
    {
        $uuid = Uuid::v4();
        $id = $uuid->toRfc4122();
        $record['extra']['uuid'] = $id;
        return $record;
    }
}