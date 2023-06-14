<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ["title", "body", "image", "school_id", "slug"];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
