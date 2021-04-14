<?php

namespace App\Http\Controllers;

use App\Traits\DataTableError;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class ErrorsImportZonesController extends Controller
{
    use DataTableError;
    /**
     * Display a listing of the resource.
     *
     * @return DataTableCollectionResource
     */
    public function index()
    {
        return new DataTableCollectionResource($this->getData());
    }
}
