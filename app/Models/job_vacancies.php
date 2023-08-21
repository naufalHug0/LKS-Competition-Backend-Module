<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\job_categories;
use App\Models\available_positions;

class job_vacancies extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $timestamps = false;

    public function job_categories() {
        return $this->belongsTo(job_categories::class, 'job_category_id');
    }

    public function available_positions() {
        return $this->hasOne(available_positions::class, 'job_vacancy_id');
    }

    public function job_apply_societies() {
        return $this->hasMany(job_apply_societies::class);
    }
}
