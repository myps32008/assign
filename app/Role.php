<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['role_code', 'role_name', 'description', 'status', 'created_by', 'updated_by'];
    public function accessMenu(){
        return $this->belongsToMany(Objects::class, 'role_object', 'role_id', 'object_id');
    }
}
