<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taglink extends Model
{
    public $fillable = ['model_id', 'model_type', 'tag_id'];

    public function Tag()
    {
        return $this->hasOne(Tag::class,'id','tag_id');
    }
}
