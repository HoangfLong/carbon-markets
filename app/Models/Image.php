<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'project_images';

    protected $fillable = [
        'project_ID',
        'image_path',
    ];

    public function projects() {
        return $this->belongsTo(Project::class, 'project_ID');
    }
}
