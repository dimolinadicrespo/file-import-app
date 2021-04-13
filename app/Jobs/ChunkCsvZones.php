<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChunkCsvZones implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $header;
    private $chunk;
    private $data;

    /**
     * ChunkCsvZones constructor.
     * @param $header
     * @param $chunk
     * @param $data
     */
    public function __construct($header, $data, $chunk)
    {
        $this->data = $data;
        $this->chunk = $chunk;
        $this->header = $header;
    }

    /**
     * Create a new job instance.
     *
     * @return void
     */


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        array_unshift($this->data , $this->header);
        $fileName = storage_path('filesImport/temp_file_'. $this->chunk . '.csv');
        file_put_contents($fileName, $this->data);
    }
}
