<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'desc',
        'image_path',
        'file_path',
        'earned_on',
        'expiry_date',
        'issuer',
        'certificate_link',
        'certificate_link_text',
    ];
}
