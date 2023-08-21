<?php

namespace App\Models;

use App\Models\regionals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class societies extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $hidden = [
        'password'
    ];

    public function regionals() {
        return $this->belongsTo(regionals::class, 'regional_id');
    }

    public function job_apply_societies () {
        return $this->belongsTo(job_apply_societies::class);
    }
}
