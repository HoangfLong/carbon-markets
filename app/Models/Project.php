<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'carbon_projects';

    protected $fillable = [
        'project_type_ID',
        'carbon_credit_ID',
        'standards_ID',
        'user_ID',
        'description',
        'validator',
        'name',
        'location',
        'developer',
        'status',
        'address',
        'total_credits',
        'registered_at',
        'is_verified',
        'created_at',
        'updated_at',
    ];

   /**
     * Định nghĩa quan hệ với các bảng liên quan
     */
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_ID');
    }

    public function credits()
    {
        return $this->hasMany(Credit::class, 'project_ID');
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standards_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    public function images() {
        return $this->hasMany(Image::class, 'project_ID');
    }
}
