<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SP500 extends Model
{
    use HasFactory;
    protected $table = 'sp500s';
    public $timestamps = false;

}
