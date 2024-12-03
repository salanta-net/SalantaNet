<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Snippet extends Model
{
    use HasFactory, HasRichText;

    protected $guarded = [];

    protected $richTextAttributes = [
        'content'
    ];
}
