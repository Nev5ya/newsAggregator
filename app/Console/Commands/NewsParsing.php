<?php

namespace App\Console\Commands;

use App\Models\Resource;
use App\Services\QueueParserService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class NewsParsing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:parsing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set news parsing queue';

    private QueueParserService $queueService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(QueueParserService $queueService)
    {
        parent::__construct();
        $this->queueService = $queueService;
    }

    /**
     * Execute the console command.
     *
     * @param Resource $resource
     * @return int Exit code
     */
    public function handle(Resource $resource): int
    {
        $this->queueService->setQueue($resource->all());
        return CommandAlias::SUCCESS;
    }
}
