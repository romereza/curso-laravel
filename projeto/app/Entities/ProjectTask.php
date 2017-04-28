<?php

namespace MerezaProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;

	protected $fillable = [
		"project_id",
		"name",
		"start_date",
		"due_date",
		"status"
	];

	/**
	 * Get the ProjectNote that owns the Project.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project() {
		return $this->belongsTo(Project::class, 'project_id', 'id');
	}

}
