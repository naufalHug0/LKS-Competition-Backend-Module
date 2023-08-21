<?php

namespace App\Models;

use App\Models\societies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class regionals extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $timestamps = false;

    public function societies() {
        return $this->hasOne(societies::class);
    }
}
