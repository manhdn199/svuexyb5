<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class RoleHasPermission extends Model
{
    use HasFactory,Sortable;
    protected $table = 'role_has_permission';
    protected $fillable = [
        'permission_id',
        'role_id',
    ];
    protected $sortable = [
        'permission_id',
        'role_id',
    ];

    public function hasRolePermission()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasPermission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
