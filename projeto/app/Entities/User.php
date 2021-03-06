<?php

namespace MerezaProject\Entities;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Get the Projects for the User.
	 */
	public function projects()
	{
//		return $this->hasMany('MerezaProject\Entities\Projects', 'owner_id', 'id');
		return $this->belongsToMany('MerezaProject\Entities\Projects', 'project_members', 'user_id', 'id');
	}


}
