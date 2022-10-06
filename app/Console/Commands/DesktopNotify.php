<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DesktopNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:desktopNotify {msg}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desktop Notification';

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
     * @return void
     */
    public function handle()
    {
        $this->notify('Task Notification', $this->argument('msg'), 'icon.png');
    }


}
