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
use Prettus\Validator\Contracts\ValidatorInterface;
use MerezaProject\Repositories\ProjectRepository;
use MerezaProject\Validators\ProjectMembersValidator;
use MerezaProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService extends DefaultService
{

	/**
	 * @var ProjectMembersValidator
	 */
	protected $validatorMember;

	/**
	 * @var string
	 */
	protected $_title = "Projeto";

	public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMembersValidator $validatorMember)
	{
		$this->repository = $repository;
		$this->validator = $validator;
		$this->validatorMember = $validatorMember;
	}

	/**
	 * Retrieve all data of repository
	 *
	 * @param array $columns
	 * @return mixed
	 */
	public function all($columns = ['*'])
	{
		return $this->repository->with(["user", "client"])->all($columns);
	}

	/**
	 * Find data by id
	 *
	 * @param $id
	 * @param array $columns
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function find($id, $columns = ['*'])
	{
		try {
			return $this->repository->with(["user", "client"])->find($id, $columns);
		} catch (QueryException $e) {
			return response()->json([
				'error' => true,
				'message' => "Erro ao procurar $this->_title. [Q]"
			], 412);
		} catch (ModelNotFoundException $e) {
			return response()->json([
				'error' => true,
				'message' => "$this->_title não encontrado."
			], 412);
		} catch (\Exception $e) {
			return response()->json([
				'error' => true,
				'message' => "Ocorreu um erro ao procurar $this->_title. [E]"
			], 412);
		}
	}

	/**
	 * Add Members
	 *
	 * @param int $project_id
	 * @param int|array $member_id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function addMember($project_id, $member_id)
	{
		try {
			$this->validatorMember->with(["project_id" => $project_id, "user_id" => $member_id])->passesOrFail(ValidatorInterface::RULE_CREATE);

			$project = $this->repository->find($project_id);
			if (!$this->isMember($project_id, $member_id)) {
				$project->members()->attach($member_id);
			}

			return $project->members()->get();
		} catch (ValidatorException $e) {
			return response()->json([
				'error' => true,
				'message' => $e->getMessageBag()
			], 412);
		} catch (QueryException $e) {
			return response()->json([
				'error' => true,
				'message' => "Erro ao inserir Membro - Projeto. [Q]"
			], 412);
		} catch (\Exception $e) {
			return response()->json([
				'error' => true,
				'message' => "Ocorreu um erro ao inserir Membro - Projeto. [E] "
			], 412);
		}
	}

	/**
	 * Delete a members in repository by id
	 *
	 * @param int $id
	 * @param int|array $member_id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function removeMember($id, $member_id)
	{
		try {
			$project = $this->repository->find($id);
			$project->members()->detach($member_id);
			return $project->members()->get();
		} catch (QueryException $e) {
			return response()->json([
				'error' => true,
				'message' => "Membro - Projeto não pode ser deletado pois existe um ou mais itens vinculados a ele(a)."
			], 412);
		} catch (ModelNotFoundException $e) {
			return response()->json([
				'error' => true,
				'message' => "Membro - Projeto não encontrado."
			], 412);
		} catch (\Exception $e) {
			return response()->json([
				'error' => true,
				'message' => "Ocorreu um erro ao excluir Membro - Projeto."
			], 412);
		}
	}

	/**
	 * Find data by member_id and project_id
	 *
	 * @param $id
	 * @param $member_id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function isMember($id, $member_id)
	{
		try {
			$item = $this->repository->find($id)->members()->find(["user_id" => $member_id]);

			if (!count($item))
				return false;

			return $item;
		} catch (QueryException $e) {
			return response()->json([
				'error' => true,
				'message' => "Erro ao procurar Membro - Projeto. [Q]"
			], 412);
		} catch (ModelNotFoundException $e) {
			return response()->json([
				'error' => true,
				'message' => "Membro - Projeto não encontrada."
			], 412);
		} catch (\Exception $e) {
			return response()->json([
				'error' => true,
				'message' => "Ocorreu um erro ao procurar Membro - Projeto. [E]"
			], 412);
		}
	}
}