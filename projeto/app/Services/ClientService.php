<?php
/**
 * Created by PhpStorm.
 * User: romereza
 * Date: 03/10/16
 * Time: 22:46
 */
/**
 * This source file is subject to the MIT License.
 * It is also available through http://opensource.org/licenses/MIT
 *
 * @copyright Copyright (c) 2014 Romero Araújo | Jazzz Produtora Web (http://www.jazzz.com.br)
 * @author    Romero Araújo <romereza@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 */

namespace MerezaProject\Services;


use MerezaProject\Repositories\ClientRepository;
use MerezaProject\Validators\ClientValidator;

class ClientService extends DefaultService
{
	/**
	 * ClientService constructor.
	 * @param ClientRepository $repository
	 * @param ClientValidator $validator
	 */
	public function __construct(ClientRepository $repository, ClientValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}
}