<?php

namespace LaSalle\GroupSeven\LogSummary\Domain;

interface LogSummaryRepository
{
    public function all(string $environment, array $levels): array;
}