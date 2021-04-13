<?php

namespace App\Http\Controllers;

use App\Utils\ChunkCsvService;
use App\Utils\StoreCsvService;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Bus;
use App\Http\Requests\ZonesImportRequest;
use Illuminate\Support\Facades\DB;
use Throwable;


class ZonesImportController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param ZonesImportRequest $request
     * @return Batch
     * @throws Throwable
     */
    public function chunk(ZonesImportRequest $request)
    {
        $chunkCsvService = new ChunkCsvService($request->file->getRealPath());
        $chunkCsvService->chuckFile();
        return $chunkCsvService->getBatch();
    }

    /**
     * @return string
     * @throws Throwable
     */
    public function store()
    {
        $processCsvService = new StoreCsvService(storage_path('filesImport/*.csv'));
        $processCsvService->process();
        return $processCsvService->getBatch();
    }

    /**
     * Display a view for show results
     *
     * @return Renderable
     */
    public function results()
    {
        return view('zones.results');
    }

    /**
     * @return Batch | array
     */
    public function getBusBatch()
    {
        $batch = DB::table('job_batches')
            ->where('name', '=', request('name'))->first();
        if ($batch)
            return Bus::findBatch($batch->id);
        return [];
    }

}
