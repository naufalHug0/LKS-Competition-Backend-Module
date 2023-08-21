<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\job_apply_positions;

class job_apply_societies extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $timestamps = false;

    public function societies() {
        return $this->belongsTo(societies::class, 'society_id');
    }

    public function job_vacancies() {
        return $this->belongsTo(job_vacancies::class, 'job_vacancy_id');
    }

    public function job_apply_positions() {
        return $this->hasMany(job_apply_positions::class);
    }
}
