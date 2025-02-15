<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];


    public function class()
    {
        return $this->belongsTo(Classes::class, 'id', 'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
