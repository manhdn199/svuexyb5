<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;

class Role extends Model
{
    use HasFactory, HasFactory, Notifiable, Sortable;
    protected $fillable = [
        'name',
    ];
    public $sortable = [
        'name',
    ];
    const MANAGER = 1;
    const ADMIN = 2;
    const MEMBER = 3;

    public function userHasRole()
    {
        return $this->hasOne(UserhasRole::class,'role_id');
    }
}


