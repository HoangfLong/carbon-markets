<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;

    protected $table = 'project_types';

    /**
     * Các trường được phép gán giá trị
     */
    protected $fillable = [
        'type_name',
        'created_at',
        'updated_at',
    ];

    /**
     * Định nghĩa quan hệ với CarbonProject
     */
    public function carbonProjects()
    {
        return $this->hasMany(Project::class, 'project_type_ID');
    }
}
