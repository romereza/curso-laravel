<?php

namespace MerezaProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectMembers extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
	    "project_id",
	    "user_id",
    ];

	/**
	 * Get the ProjectMembers that owns the Project.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project() {
		return $this->belongsTo(Project::class, 'project_id', 'id');
	}

	/**
	 * Get the ProjectMembers that owns the User.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

}
