<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DataTableCollectionResource
     */
    public function index()
    {
        $result = DB::table('zones')
            ->select('zone_id', 'zone_name', DB::raw('count(*) as num'), DB::raw('MIN(start_date) as min_date'), DB::raw('MAX(finish_date) as max_date'))
            ->groupBy('zone_id', 'zone_name')
            ->orderBy('zone_id')
            ->paginate(10);

        return new DataTableCollectionResource($result);
    }
}
