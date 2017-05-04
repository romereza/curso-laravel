<?php

namespace MerezaProject\Http\Controllers;

use Illuminate\Http\Request;

use MerezaProject\Entities\ProjectTask;
use MerezaProject\Http\Requests;
use MerezaProject\Services\ProjectMemberService;


class ProjectMembersController extends Controller
{

	/**
	 * @var ProjectMemberService
	 */
	private $service;

	/**
	 * ProjectMembersController constructor.
	 * @param ProjectMemberService $service
	 */
	public function __construct(ProjectMemberService $service) {
		$this->service = $service;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($id)
	{
		return $this->service->allByProject($id);
	}
}
