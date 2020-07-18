<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_Object extends Model
{
    protected $table = 'role_object';
    protected $fillable = ['object_id', 'role_id', 'status', 'created_by'];
}
