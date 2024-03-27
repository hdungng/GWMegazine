<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}