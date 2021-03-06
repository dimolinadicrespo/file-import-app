<?php

namespace App\Utils;

use App\Jobs\ChunkCsvZones;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChunkCsvService
{
    public const CHUNK_SIZE = 5000;
    protected $filePath;
    protected $batch;

    /**
     * @return Batch
     */
    public function getBatch(): Batch
    {
        return $this->batch;
    }

    /**
     * ChunkCsvService constructor.
     * @param $filePath
     * @throws \Throwable
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->batch = self::getOrCreateBatch();
    }

    /**
     * Chuck file in parts based on the CHUNK_SIZE property
     * @throws \Throwable
     */
    public function chuckFile()
    {
        $header = file($this->filePath)[0];
        $data =  array_slice(file($this->filePath),1);

        $parts = (array_chunk($data, self::CHUNK_SIZE));

        $path = storage_path('filesImport');
        if (!file_exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        foreach ($parts as $key => $part) {
            $this->batch->add(new ChunkCsvZones($header, $part, $key));
        }
    }

    /**
     * Get the batch if exist or create
     * @return Batch|null
     */
    public function getOrCreateBatch()
    {
        $batch = DB::table('job_batches')->where('name', '=', 'Chunk Csv')->first();
        if (!$batch) {
            try {
                return Bus::batch([])->name('Chunk Csv')->dispatch();
            } catch (\Throwable $e) {
            }
        }
        return Bus::findBatch($batch->id);
    }
}
