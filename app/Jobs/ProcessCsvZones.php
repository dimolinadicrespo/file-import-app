<?php

namespace App\Jobs;

use App\Models\Errors;
use App\Models\Zone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;

class ProcessCsvZones implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $now;
    private $chunkPart;

    /**
     * Process2Csv constructor.
     * @param $chunkPart
     * @param $now
     */
    public function __construct($chunkPart, $now)
    {
        $this->chunkPart = $chunkPart;
        $this->now = $now;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array_map(function($row) { return str_getcsv($row,";");}, file($this->chunkPart));

        $header = $data[0];
        unset($data[0]);
        $header[4] = 'created_at';
        $header[5] = 'updated_at';

        $bulkData = [];
        $originalSize = count($data);

        foreach ($data as $key => $zone) {
            $zone['created_at'] = $this->now;
            $zone['updated_at'] = $this->now;
            $bulkData[] = array_combine($header, $zone);
        }

        $withoutErrors = [];
        $lineErrors = [];

        array_filter($bulkData, function ($value, $key) use (&$withoutErrors, &$lineErrors) {
            if ($value['zone_id'] !== '' && is_numeric($value['zone_id']) &&
                $value['zone_name'] !== '' && strlen($value['zone_name']) === 1 &&
                $value['start_date'] !== '' && strtotime($value['start_date']) !== false &&
                $value['finish_date'] !== '' && strtotime($value['finish_date']) !== false) {
                $withoutErrors[] = $value;
            } else {
                $lineErrors[] = ($key + 2);
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH);


        Zone::insert($withoutErrors);
        if (count($lineErrors) > 0) {
            Errors::create([
                'file_chunk' => basename($this->chunkPart),
                'number_of_errors' => $originalSize - count($withoutErrors),
                'line_numbers' => implode(",", $lineErrors),
            ]);
        }
    }
}
