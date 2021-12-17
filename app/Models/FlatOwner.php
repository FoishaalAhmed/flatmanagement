<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'flat_id', 'owner_id',
    ];
}
