<?php

namespace App\Console\Commands;

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
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,'https://api.discogs.com/users/'.env('DISCOGS_USERNAME').'/collection/folders?token='. env('DISCOGS_TOKEN'));
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'record-app');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        $jsonget = json_decode($query, true);

        foreach ($jsonget['folders'] as $folder) {
            $this->info($folder['name']);
            Folder::updateOrCreate([
                'id' => $folder['id']],[
                'name' => $folder['name']
            ]);
        }
    }
}
