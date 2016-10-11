<?php
/**
 * Created by PhpStorm.
 * User: romereza
 * Date: 09/10/16
 * Time: 22:24
 */
/**
 * This source file is subject to the MIT License.
 * It is also available through http://opensource.org/licenses/MIT
 *
 * @copyright Copyright (c) 2014 Romero Araújo | Jazzz Produtora Web (http://www.jazzz.com.br)
 * @author    Romero Araújo <romereza@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 */

namespace MerezaProject\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
	protected  $rules = [
		ValidatorInterface::RULE_CREATE => [
			'name' => 'required|max:255',
			'responsible' => 'required|max:255',
			'email' => 'required|email|unique:clients,email',
			'phone' => 'required',
			'address' => 'required'
		],

		ValidatorInterface::RULE_UPDATE => [
			'name' => 'sometimes|required|max:255',
			'responsible' => 'sometimes|required|max:255',
			'email' => 'sometimes|required|email|unique:clients,email',
			'phone' => 'sometimes|required',
			'address' => 'sometimes|required'
		]
	];

	/**
	 * @param null $clientId
	 */
	public function setRuleEmailUniqueIgnoreId($clientId = null) {
		$this->rules[ValidatorInterface::RULE_UPDATE]['email'] = 'sometimes|required|email|unique:clients,email,'.$clientId;
	}
}