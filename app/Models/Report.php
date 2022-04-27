<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $fillable = [
        'project_id',
        'position_id',
        'working_time',
        'working_type',
        'detail',
        'status',
        'user_id',
        'time'
    ];
}
