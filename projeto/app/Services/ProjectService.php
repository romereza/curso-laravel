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


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use MerezaProject\Repositories\ProjectRepository;
use MerezaProject\Validators\ProjectValidator;


class ProjectService extends DefaultService
{

	/**
	 * @var string
	 */
	protected $_title = "Projeto";

	public function __construct(ProjectRepository $repository, ProjectValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}
	/**
	 * Retrieve all data of repository
	 *
	 * @param array $columns
	 *
	 * @return mixed
	 */
	public function all($columns = ['*']) {
		return $this->repository->with(["user", "client"])->all($columns);
	}

	/**
	 * Find data by id
	 *
	 * @param       $id
	 * @param array $columns
	 *
	 * @return mixed
	 */
	public function find($id, $columns = ['*']) {
		try{
			return $this->repository->with(["user", "client"])->find($id, $columns);
		}catch(QueryException $e){
			return response()->json([
				'error' => true,
				'message' => "Erro ao procurar $this->_title. [Q]"
			],412);
		}catch(ModelNotFoundException $e){
			return response()->json([
				'error' => true,
				'message' => "$this->_title não encontrado."
			],412);
		}catch(\Exception $e){
			return response()->json([
				'error' => true,
				'message' => "Ocorreu ao procurar $this->_title. [E]"
			],412);
		}
	}
}