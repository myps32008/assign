<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $fillable = [
        'username', 'fullname', 'email', 'phone', 'address', 'status', 'image', 'password',
        'created_by', 'updated_by'
    ];
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }
    public function accessMenu()
    {
        if ($this->username === 'administrator') {
            return Objects::with('childMenu')->get();
        }
        return DB::table('role_users')->where('user_id', $this->id)
            ->join('role_object', 'role_users.role_id', '=', 'role_object.object_id')
            ->join('objects', 'role_object.object_id', '=', 'objects.id')
            ->select(Objects::class)
            ->distinct()->get();
    }
}
