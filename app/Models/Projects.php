<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Projects extends Model
{
    use HasFactory, Sortable;
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'detail',
        'duration',
        'revenue',
        'start',
        'end'
    ];

    public $sortable = [
        'name',
        'detail',
        'duration',
        'revenue',
        'start',
        'end'
    ];
}
