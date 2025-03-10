<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;

    protected $table = 'standards';

    /**
     * Các trường được phép gán giá trị
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Định nghĩa quan hệ với CarbonProject
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'standards_ID');
    }
}
