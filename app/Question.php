<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'active','dimension_id'
    ];

    protected $dates = ['deleted_at'];

    public function dimension()
    {
        return $this->belongsTo(Dimension::class);
    }
}
