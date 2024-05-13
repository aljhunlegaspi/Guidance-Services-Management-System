<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Violation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'type',
        'description',
        'penalty_type',
        'submission_status',
    ];
   
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
