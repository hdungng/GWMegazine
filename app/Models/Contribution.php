<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'status',
        'image_url',
        'html_url',
        'word_url',
        'academic_year_id'
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
