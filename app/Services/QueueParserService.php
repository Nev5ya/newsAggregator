<?php

namespace App\Services;

use App\Jobs\NewsParsing;
use Illuminate\Support\Collection;

class QueueParserService
{
    public function setQueue(Collection $resources): void
    {
        foreach ($resources as $item) {
            NewsParsing::dispatch($item->link);
        }
    }
}
