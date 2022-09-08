<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['permission_name'];


    public function getPermissionNameAttribute(){
        $permissionName = null;
        if($this->role_id === 3){
            $permissionName = 'Admin';
        }
        else if($this->role_id === 2){
            $permissionName = 'Manager';
        }
        else if($this->role_id === 1){
            $permissionName = 'User';
        }
        return $permissionName;

    }



    // Böyle user tablosundan role tablosuna erişim sağlanabilir ama performans düşer

    // public function permission(){
    //     return $this->hasOne(Role::class,'id', 'role_id');
    // }


}
