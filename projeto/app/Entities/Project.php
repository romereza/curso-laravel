<?php

namespace MerezaProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = [
		"owner_id",
		"client_id",
		"name",
		"description",
		"progress",
		"status",
		"due_date"
	];

	/**
	 * Get the Project that owns the User(Owner).
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo('MerezaProject\Entities\User', 'owner_id', 'id');
	}


	/**
	 * Get the Project that owns the Client.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client() {
		return $this->belongsTo('MerezaProject\Entities\Client', 'client_id', 'id');
	}

	/**
	 * Get the ProjectNote for the Project.
	 */
	public function notes()
	{
		return $this->hasMany(ProjectNote::class, 'project_id', 'id');
	}
}
