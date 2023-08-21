<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\job_vacancies;
use App\Models\job_apply_positions;

class available_positions extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $timestamps = false;

    public function job_vacancies() {
        return $this->belongsTo(job_vacancies::class, 'job_vacancy_id');
    }

    public function job_apply_positions () {
        return $this->hasOne(job_apply_positions::class, 'position_id', 'id');
    }
}
