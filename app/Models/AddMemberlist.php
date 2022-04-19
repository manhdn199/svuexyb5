<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddMemberlist extends Model
{
    use HasFactory;
    protected $table = 'memberlist';
    protected $fillable = [
        'user_id',
        'position_id',
        'project_id'
    ];
}


