<?php

namespace MerezaProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'owner_id' => 'required|integer|exists:users,id',
			'client_id' => 'required|integer|exists:clients,id',
			'name' => 'required|max:255',
			'description' => 'required',
			'progress' => 'required|integer|max:100',
			'status' => 'required|integer|max:3|min:1',
			'due_date' => 'date_format:Y-m-d H:i:s'
		],

		ValidatorInterface::RULE_UPDATE => [
			'owner_id' => 'sometimes|required|exists:users,id',
			'client_id' => 'sometimes|required|exists:clients,id',
			'name' => 'sometimes|required|max:255',
			'description' => 'sometimes|required',
			'progress' => 'sometimes|required|max:100',
			'status' => 'sometimes|required|max:3|min:1',
			'due_date' => 'sometimes|date_format:Y-m-d H:i:s'
		]
	];
}
