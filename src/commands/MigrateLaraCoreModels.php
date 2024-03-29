<?php

namespace Sawan\Core\Commands;

use Illuminate\Console\Command;

class MigrateLaraCoreModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laracore:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Lara Core tables to db';

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
        //return Artisan::call('migrate', ['--path' => 'packages/lara/core/src/database/migrations' ]);
    }
}
