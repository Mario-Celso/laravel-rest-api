<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'dimension', 'active'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
