<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objects extends Model
{
    protected $table = 'objects';
    protected $fillable =
    [
        'parent_id', 'object_code', 'object_url', 'object_name',
        'description', 'object_level', 'status', 'show_menu',
        'created_by', 'updated_by', 'menu_name'
    ];
    public function childMenu (){
        return $this->hasMany(Objects::class, 'parent_id', 'id');
    }
    public function parentMenu(){
        return $this->belongsTo(Objects::class, 'parent_id', 'id');
    }
}
