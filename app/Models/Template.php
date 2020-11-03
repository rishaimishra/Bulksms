<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    const SMS = 'SMS';
    const EMAIL = 'EMAIL';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'title',
        'text',
        'type'
    ];
}
