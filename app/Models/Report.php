<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Report extends Model
{
    use HasFactory, Sortable;
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

    public $sortable = [
        'projects.name',
        'positions.name',
        'working_time',
        'working_type',
        'detail',
        'status',
        'users.name',
        'time'
    ];
}
