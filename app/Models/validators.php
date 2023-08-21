<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class validators extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $timestamps = false;
    public function validations () {
        return $this->hasMany(validations::class);
    }
}
