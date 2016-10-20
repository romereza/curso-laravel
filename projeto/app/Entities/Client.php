<?php

namespace MerezaProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	"name",
    	"responsible",
    	"email",
    	"phone",
    	"address",
    	"obs"
	];

	/**
	 * Get the Projects for the Client.
	 */
	public function projects()
	{
		return $this->hasMany('MerezaProject\Entities\Projects', 'client_id', 'id');
	}
}
