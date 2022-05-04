<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberList extends Model
{
    use HasFactory;
    protected $table = 'memberList';
    protected $fillable = [
      'user_id',
      'position_id',
      'project_id'
    ];
    public function hasUser()
    {
    return $this->belongsTo(User::class,'user_id');
    }
    public function hasPosition()
    {
        return $this->belongsTo(Position::class,'position_id');
    }
    public function hasProject()
    {
        return $this->belongsTo(Projects::class,'project_id');
    }
}
