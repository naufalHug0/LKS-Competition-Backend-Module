<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\job_vacancies;

class job_categories extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $timestamps = false;

    public function job_vacancies() {
        return $this->hasOne(job_vacancies::class);
    }
}
