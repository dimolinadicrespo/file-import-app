<?php


namespace App\Utils;

use Illuminate\Bus\Batch;
use App\Jobs\ProcessCsvZones;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class StoreCsvService
{

    protected $batch;
    protected $directoryPath;


    /**
     * @return Batch
     */
    public function getBatch(): Batch
    {
        return $this->batch;
    }

    /**
     * ChunkCsvService constructor.
     * @param $directoryPath
     * @throws \Throwable
     */
    public function __construct($directoryPath)
    {
        $this->directoryPath = $directoryPath;
        $this->batch = self::getOrCreateBatch();
    }

    /**
     * Proccess The Csv and insert in db
     */

    public function process()
    {
        $allChunkFiles = glob($this->directoryPath);
        $now = now()->toDateTimeString();

        foreach ($allChunkFiles as $key => $chunkPart) {
            $this->batch->add(new ProcessCsvZones($chunkPart, $now));
        }
    }

    /**
     * Get the batch if exist or create
     * @return Batch|null
     */
    public function getOrCreateBatch()
    {
        $batch = DB::table('job_batches')->where('name', '=', 'Process Csv')->first();
        if (!$batch) {
            try {
                return Bus::batch([])->name('Process Csv')->dispatch();
            } catch (\Throwable $e) {
            }
        }
        return Bus::findBatch($batch->id);
    }
}
