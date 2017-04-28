<?php

namespace MerezaProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'project_id' => 'required|integer|exists:projects,id',
			'name' => 'required|max:255',
			'start_date' => 'date_format:Y-m-d',
			'due_date' => 'date_format:Y-m-d',
			'status' => 'required|integer|max:3|min:1'
		],
		ValidatorInterface::RULE_UPDATE => [
			'project_id' => 'sometimes|required|exists:projects,id',
			'name' => 'sometimes|required|max:255',
			'start_date' => 'sometimes|date_format:Y-m-d',
			'due_date' => 'sometimes|date_format:Y-m-d',
			'status' => 'sometimes|required|max:3|min:1'
		],
	];
}
