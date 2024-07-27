<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'project_id', 'title', 'desc'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
