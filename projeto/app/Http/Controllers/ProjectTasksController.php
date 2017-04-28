<?php

namespace MerezaProject\Http\Controllers;

use Illuminate\Http\Request;

use MerezaProject\Entities\ProjectTask;
use MerezaProject\Http\Requests;
use MerezaProject\Services\ProjectTaskService;


class ProjectTasksController extends Controller
{

	/**
	 * @var ProjectTaskService
	 */
	private $service;

	/**
	 * ProjectTasksController constructor.
	 * @param ProjectTaskService $service
	 */
	public function __construct(ProjectTaskService $service) {
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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		return $this->service->create($request->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @param  int  $taskId
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id, $taskId)
	{
		return $this->service->findByProject($id, $taskId);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		return $this->service->update($request->all(), $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		return $this->service->delete($id);
	}
}
