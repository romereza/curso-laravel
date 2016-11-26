<?php

namespace MerezaProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
			'project_id' => 'required|integer|exists:projects,id',
			'title' => 'required|max:255',
			'note' => 'required',
		],
        ValidatorInterface::RULE_UPDATE => [
			'project_id' => 'sometimes|required|exists:projects,id',
			'title' => 'sometimes|required|max:255',
			'note' => 'sometimes|required',
		],
   ];
}
