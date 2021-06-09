<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_name'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function items()
    {
        return $this->hasMany(Items::class);
    }
}
