<?php

namespace App\Models;

use App\Models\Screenshot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'mainImage',
        'shortDesc',
        'desc',
        'overview',
        'features',
        'technical',
        'challenge',
        'outcome',
        'screenshots',
        'reference',
    ];

    public function screenshots()
    {
        return $this->hasMany(Screenshot::class);
    }
}
