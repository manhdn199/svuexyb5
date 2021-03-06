<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class UserhasRole extends Model
{
    use HasFactory, Sortable;
    protected $table = 'user_has_role';
    protected $fillable = [
        'user_id',
        'role_id',
    ];
    protected $sortable = [
        'user_id',
        'role_id',
    ];
    public function hasUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function hasRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

}


