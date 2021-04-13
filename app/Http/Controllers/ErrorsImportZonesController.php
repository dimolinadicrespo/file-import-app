<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class ErrorsImportZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DataTableCollectionResource
     */
    public function index()
    {
        $result = DB::table('errors')
            ->select('file_chunk', 'number_of_errors', 'line_numbers')
            ->orderBy('file_chunk')
            ->paginate(10);

        return new DataTableCollectionResource($result);
    }
}
