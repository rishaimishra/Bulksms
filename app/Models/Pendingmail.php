<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendingmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'from',
        'body'
    ];
}
