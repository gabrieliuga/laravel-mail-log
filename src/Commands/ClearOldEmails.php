<?php

namespace Giuga\LaravelMailLog\Commands;

use Carbon\Carbon;
use Giuga\LaravelMailLog\Models\MailLog;
use Illuminate\Console\Command;

class ClearOldEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'giuga:purge-mail-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove mails saved before the time defined in the config';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (config('mail-log.purge')) {
            $beforeDate = Carbon::now()->subDays(config('mail-log.purge_after'));
            $toRemove = MailLog::where('created_at', '<', $beforeDate)->get();
            foreach ($toRemove as $item) {
                $item->delete();
            }
        }
    }
}
