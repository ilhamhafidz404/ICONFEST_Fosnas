<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ["name", "address", "description", "images", "map"];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
