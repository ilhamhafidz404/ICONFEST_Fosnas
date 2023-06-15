<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "school_id", "status"];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($task) {
            $task->users()->detach(); // Menghapus semua relasi many-to-many pada task yang akan dihapus
        });
    }
}
