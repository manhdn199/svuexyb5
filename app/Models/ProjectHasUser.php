<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHasUser extends Model
{
    use HasFactory;
    protected $table = 'project_has_user';
    protected $fillable = [
        'user_id',
        'project_id',
    ];
    public function hasUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function hasProject()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
