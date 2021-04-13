<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errors extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    use HasFactory;
}
