<?php

namespace App\Console\Commands;

use App\CurlHelper;
use App\Field;
use Illuminate\Console\Command;

class InsertFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fields:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $url = 'https://api.discogs.com/users/'.env('DISCOGS_USERNAME').'/collection/fields?token='. env('DISCOGS_TOKEN');
        $jsonget = CurlHelper::hitApi($url);

        foreach ($jsonget['fields'] as $folder) {
            $this->info($folder['name']);
            Field::updateOrCreate([
                'id' => $folder['id']],[
                'name' => $folder['name']
            ]);
        }
    }
}
