<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class snippets extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'code',
        'instructionsId',
        'vendorId' ,
        'authorId',
        'statusId',
        'listPosition'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId');
    }

    public function vendor()
    {
        return $this->belongsTo(vendors::class, 'vendorId');
    }

    public function instruction()
    {
        return $this->belongsTo(Instructions::class, 'instructionsId');
    }

}
