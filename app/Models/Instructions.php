<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Instructions extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'authorId',
        'statusId'
    ];

    public function snippets()
    {
        return $this->hasMany(snippets::class, 'instructionsId');
    }
}
