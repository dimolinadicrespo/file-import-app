<?php

namespace App\Http\Controllers;

use App\Traits\DataTableZone;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class ZonesController extends Controller
{
    use DataTableZone;
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
