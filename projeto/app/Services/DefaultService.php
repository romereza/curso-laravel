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
use MerezaProject\Repositories\ClientRepository;
use MerezaProject\Validators\ClientValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class DefaultService
{
	/**
	 * @var ClientRepository
	 */
	protected $repository;

	/**
	 * @var ClientValidator
	 */
	protected $validator;

	/**
	 * @var string
	 */
	protected $_title = "Item";

	/**
	 * DefaultService constructor.
	 * @param ClientRepository $repository
	 * @param ClientValidator $validator
	 */
	public function __construct(ClientRepository $repository, ClientValidator $validator)
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
		return $this->repository->all($columns);
	}


	/**
	 * Find data by id
	 *
	 * @param $id
	 * @param array $columns
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function find($id, $columns = ['*']) {
		try{
			return $this->repository->find($id, $columns);
		}catch(QueryException $e){
			return response()->json([
				'error' => true,
				'message' => "Erro ao procurar $this->_title. [Q]"
			],412);
		}catch(ModelNotFoundException $e){
			return response()->json([
				'error' => true,
				'message' => "$this->_title não encontrado(a)."
			],412);
		}catch(\Exception $e){
			return response()->json([
				'error' => true,
				'message' => "Ocorreu ao procurar $this->_title. [E]"
			],412);
		}
	}

	/**
	 * @param array $data
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function create(array $data) {

		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			return $this->repository->create($data);
		} catch (ValidatorException $e) {
			return response()->json([
				'error' => true,
				'message' => $e->getMessageBag()
			],412);
		}catch(QueryException $e){
			return response()->json([
				'error' => true,
				'message' => "Erro ao inserir $this->_title. [Q]"
			],412);
		}catch(\Exception $e){
			return response()->json([
				'error' => true,
				'message' => "Ocorreu ao inserir $this->_title. [E]"
			],412);
		}
	}

	/**
	 * @param array $data
	 * @param $id
	 * @return mixed
	 */
	public function update(array $data, $id) {
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			return $this->repository->update($data, $id);
		} catch (ValidatorException $e) {
			return response()->json([
				'error' => true,
				'message' => $e->getMessageBag()
			],412);
		}catch(QueryException $e){
			return response()->json([
				'error' => true,
				'message' => "Erro ao atualizar $this->_title. [Q]"
			],412);
		} catch(ModelNotFoundException $e) {
			return response()->json([
				'error' => true,
				'message' => "$this->_title não encontrado(a)."
			],412);
		}catch(\Exception $e){
			return response()->json([
				'error' => true,
				'message' => "Ocorreu ao atualizar $this->_title. [E]"
			],412);
		}
	}

	/**
	 * Create new Clients
	 *
	 * @param array $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function storeMany(array $data)
	{
		$lineError =[];
		$preError = [];

		DB::beginTransaction();

		foreach ($data as $key => $o) {

			if($this->validator->with($o)->passesOrFail(ValidatorInterface::RULE_CREATE)){
				$this->repository->create($o);
			}else{
				$lineError[$key]['val'] = $this->validator->errorsBag()->getMessageBag();
				array_push($preError, $lineError[$key]);
			}
		}

		if(count($preError) > 0){
			DB::rollBack();
			return response()->json($preError, 412);
		}else{
			DB::commit();
		}
	}


	/**
	 * Delete a entity in repository by id
	 *
	 * @param $id
	 * @return array
	 */
	public function delete($id) {
		try{
			$this->repository->skipPresenter()->find($id)->delete();
			return response()->json([
				'success' => true,
				'message' => "$this->_title deletado(a) com sucesso!"
			],200);
		}catch(QueryException $e){
			return response()->json([
				'error' => true,
				'message' => "$this->_title não pode ser apagado(a) pois existe um ou mais itens vinculados a ele(a)."
			],412);
 		}catch(ModelNotFoundException $e){
			return response()->json([
				'error' => true,
				'message' => "$this->_title não encontrado(a)."
			],412);
 		}catch(\Exception $e){
			return response()->json([
				'error' => true,
				'message' => "Ocorreu um erro ao excluir $this->_title."
			],412);
 		}
	}
}