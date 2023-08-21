<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\available_positions;
use App\Models\job_apply_societies;

class job_apply_positions extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $timestamps = false;

    public function available_positions () {
        return $this->belongsTo(available_positions::class, 'position_id', 'id');
    }

    public function job_apply_societies () {
        return $this->belongsTo(job_apply_societies::class);
    }
}
