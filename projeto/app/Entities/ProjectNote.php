<?php

namespace MerezaProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectNote extends Model implements Transformable
{
    use TransformableTrait;

	protected $fillable = [
		"project_id",
		"title",
		"note",
	];

	/**
	 * Get the ProjectNote that owns the Project.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project() {
		return $this->belongsTo(Project::class, 'project_id', 'id');
	}

}
