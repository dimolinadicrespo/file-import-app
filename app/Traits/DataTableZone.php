<?php

namespace App\Traits;


use Illuminate\Support\Facades\DB;

trait DataTableZone
{
    function getData()
    {
        $search = request('search');
        $paginateLength = request('length') ?: 10;
        $column = request('column')  === 'id' ? 'zone_id' : request('column');
        $direction = request('dir') ?: 'asc';

        if ($search || $column || $direction) {

            $subSelect = DB::table('zones')
                ->selectRaw('zone_id, zone_name, count(*) as num, MIN(start_date) as min_date, MAX(finish_date) as max_date')
                ->where('zone_name', 'LIKE', '%'.$search.'%')
                ->orWhere('zone_id', 'LIKE', '%'.$search.'%')
                ->orWhere('start_date', 'LIKE', '%'.$search.'%')
                ->orWhere('finish_date', 'LIKE', '%'.$search.'%')
                ->groupBy('zone_id', 'zone_name');

            return DB::table(DB::raw("({$subSelect->toSql()}) as Z"))
                ->mergeBindings($subSelect)
                ->select('Z.zone_id', 'Z.zone_name', 'Z.num', 'Z.min_date', 'Z.max_date')
                ->orderBy("Z.$column", $direction)
                ->paginate($paginateLength);

        }

        return DB::table('zones')
            ->select('zone_id', 'zone_name', DB::raw('count(*) as num'), DB::raw('MIN(start_date) as min_date'),
                DB::raw('MAX(finish_date) as max_date'))
            ->groupBy('zone_id', 'zone_name')
            ->orderBy('zone_id')
            ->paginate($paginateLength);
    }
}
