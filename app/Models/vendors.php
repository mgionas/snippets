<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendors extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'img',
        'authorId',
        'statusId'
    ];


}
