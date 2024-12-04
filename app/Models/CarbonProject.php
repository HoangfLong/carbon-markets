<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarbonProject extends Model
{
    protected $table = 'carbon_projects';

    protected $fillable = [
        'name',
        'description',
        'location',
        'developer',
        'start_date',
        'end_date',
    ];

    public function credits() {
        return $this->hasMany(CarbonCredit::class,'project_id');
        //Trong model CarbonProject, ta sẽ định nghĩa mối quan hệ 
        //hasMany để lấy danh sách các CarbonCredit thuộc về dự án đó
    }
}
