<?php

namespace App\Traits;


use Illuminate\Support\Facades\DB;

trait DataTableError {
    function getData()
    {
        $search = request('search');
        $paginateLength = request('length') ?: 10;
        $column = request('column')  ?:  'id';
        $direction = request('dir') ?: 'asc';

        if ($search || $column || $direction) {

            return DB::table('errors')
                ->selectRaw('file_chunk, number_of_errors, line_numbers')
                ->where('file_chunk', 'LIKE', '%'.$search.'%')
                ->orWhere('number_of_errors', 'LIKE', '%'.$search.'%')
                ->orWhere('line_numbers', 'LIKE', '%'.$search.'%')
                ->paginate($paginateLength);
        }

        return DB::table('errors')
            ->select('file_chunk', 'number_of_errors', 'line_numbers')
            ->orderBy('file_chunk')
            ->paginate($paginateLength);
    }
}

