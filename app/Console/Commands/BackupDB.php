<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;


class BackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creating a backup db for the application';

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
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $dbName = env('DB_DATABASE');
        $extention = storage_path('app/dbBackups/');
        $fileName = $extention . 'ebooktemp-' . Carbon::now()->format('d-m-Y');
        $command = "mysqldump -e -f -u $username -p$password $dbName > $fileName.sql";

        $process = new Process($command);

        $process->start();

        while ($process->isRunning()) {

            $this->info('backup is running now');

        }

        if ($process->isSuccessful()) {

            $this->info('backup is done');

        } else {

            $this->error('error occured !!' . $process->getErrorOutput());
        }

    }
}
