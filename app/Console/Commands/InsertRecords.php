<?php

namespace App\Console\Commands;

use App\Artist;
use App\CurlHelper;
use App\Record;
use Illuminate\Console\Command;

class InsertRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'records:insert';

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
        $url = 'https://api.discogs.com/users/'.env('DISCOGS_USERNAME').'/collection/folders/0/releases?token='. env('DISCOGS_TOKEN');
        $jsonget = CurlHelper::hitApi($url);
        $this->insertReleases($jsonget['releases']);
        $this->info('Page ' . $jsonget['pagination']['page'] . ' Inserted');

        while(isset($jsonget['pagination']['urls']['next'])) {
            $jsonget = CurlHelper::hitApi($jsonget['pagination']['urls']['next']);
            $this->insertReleases($jsonget['releases']);
            $this->info('Page ' . $jsonget['pagination']['page'] . ' Inserted');
        }
    }

    private function insertReleases($releases)
    {
        foreach($releases as $release) {
            $binfo = $release['basic_information'];

            Artist::updateOrCreate([
                'id' => $binfo['artists'][0]['id']
            ],[
                'name' => $binfo['artists'][0]['name']
            ]);

            $record = Record::updateOrCreate([
                'id' => $release['instance_id']
            ],[
                'title' => $binfo['title'],
                'year' => $binfo['year'],
                'thumb' => $binfo['thumb'],
                'cover' => $binfo['cover_image'],
                'artist_id' => $binfo['artists'][0]['id'],
                'folder_id' => $release['folder_id']
            ]);

            if(isset($release['notes'])) {
                $sync_arr = collect($release['notes'])->keyBy('field_id');
                $record->fields()->sync($sync_arr);
            }
        }
    }
}
