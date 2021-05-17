<?php

namespace App\Console\Commands;

use App\Jobs\LongRunningJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class DispatchLongRunningJobBatch extends Command
{
    protected $signature = 'dispatch-jobs';

    protected $description = 'Dispatch batch of long running jobs';

    public function handle()
    {
        $jobs = collect(range(1, 500))->map(fn () => new LongRunningJob);

        Bus::batch($jobs)->onConnection('redis')->dispatch();
    }
}
