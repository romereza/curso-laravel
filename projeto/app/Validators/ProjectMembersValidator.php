<?php

namespace MerezaProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectMembersValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
	        'project_id' => 'required|integer|exists:projects,id',
	        'user_id' => 'required|integer|exists:users,id',
        ],
        ValidatorInterface::RULE_UPDATE => [
	        'project_id' => 'sometimes|required|exists:projects,id',
	        'user_id' => 'sometimes|required|exists:users,id',
        ],
   ];
}
