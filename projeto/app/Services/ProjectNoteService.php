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
use League\Flysystem\Exception;
use MerezaProject\Repositories\ProjectNoteRepository;
use MerezaProject\Validators\ProjectNoteValidator;


class ProjectNoteService extends DefaultService
{

	/**
	 * @var string
	 */
	protected $_title = "Nota - Projeto";

	public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}
	/**
	 * Retrieve all data of repository by Project
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function allByProject($id) {
		try{
			return $this->repository->findWhere(['project_id' => $id]);
		}catch(QueryException $e){
			return response()->json([
				'error' => true,
				'message' => "Erro ao procurar $this->_title. [Q]"
			],412);
		}catch(ModelNotFoundException $e){
			return response()->json([
				'error' => true,
				'message' => "Nenhuna $this->_title encontrada."
			],412);
		}catch(\Exception $e){
			return response()->json([
				'error' => true,
				'message' => "Ocorreu um erro ao procurar $this->_title. [E]"
			],412);
		}
	}

	/**
	 * Find data by id and project_id
	 *
	 * @param $id
	 * @param $noteId
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function findByProject($id, $noteId) {
		try{
			$item = $this->repository->with(["project"])->findWhere(['project_id' => $id, 'id' => $noteId]);

			if (!count($item))
				return response()->json([
					'error' => true,
					'message' => "$this->_title não encontrada."
				],412);

			return $item;
		}catch(QueryException $e){
			return response()->json([
				'error' => true,
				'message' => "Erro ao procurar $this->_title. [Q]"
			],412);
		}catch(ModelNotFoundException $e){
			return response()->json([
				'error' => true,
				'message' => "$this->_title não encontrada."
			],412);
		}catch(\Exception $e){
			return response()->json([
				'error' => true,
				'message' => "Ocorreu um erro ao procurar $this->_title. [E]"
			],412);
		}
	}
}