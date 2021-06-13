<?php

namespace LaSalle\GroupSeven\Log\Infrastructure\Persistence;

use LaSalle\GroupSeven\Log\Domain\LogEntry;
use LaSalle\GroupSeven\Log\Domain\Repository\LogRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Finder\Finder;

final class FilesystemLogRepository implements LogRepository
{
    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function findLogEntriesByEnvironment(string $environment): array
    {
        $finder = new Finder();
        $finder->files()->in($this->parameterBag->get('kernel.logs_dir'))->name($environment.'*.log');
        if ($finder->hasResults()) {
            $contentArrayLogEntries = [];
            foreach ($finder as $file) {
                $contents = $file->getContents();
                $contentArrayFile = array_filter(explode("\n", $contents));
                foreach ($contentArrayFile as $contentFileLine) {
                    $contentFileLineDecoded = json_decode($contentFileLine, true);
                    $contentArrayLogEntries[] = new LogEntry(
                        $contentFileLineDecoded["extra"]["uuid"],
                        $environment,
                        $contentFileLineDecoded["level_name"],
                        $contentFileLineDecoded["message"],
                        $contentFileLineDecoded["datetime"]
                    );
                }
            }
            return $contentArrayLogEntries;
        }
        return [];
    }

    public function save(LogEntry $logEntry): void
    {
    }
}