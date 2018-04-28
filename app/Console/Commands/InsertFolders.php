<?php

namespace App\Console\Commands;

use App\CurlHelper;
use App\Folder;
use Illuminate\Console\Command;

class InsertFolders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folders:insert';

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
        $url = 'https://api.discogs.com/users/'.env('DISCOGS_USERNAME').'/collection/folders?token='. env('DISCOGS_TOKEN');
        $jsonget = CurlHelper::hitApi($url);

        foreach ($jsonget['folders'] as $folder) {
            $this->info($folder['name']);
            Folder::updateOrCreate([
                'id' => $folder['id']],[
                'name' => $folder['name']
            ]);
        }
    }
}
