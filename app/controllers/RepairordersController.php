<?php

class RepairordersController extends \BaseController {

	/**
	 * Display a listing of repairorders
	 *
	 * @return Response
	 */
	public function index()
	{
		$repairorders = Repairorder::all();

		return View::make('repairorders.index', compact('repairorders'));
	}

	/**
	 * Show the form for creating a new repairorder
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('repairorders.create');
	}

	/**
	 * Store a newly created repairorder in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Repairorder::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Repairorder::create($data);

		return Redirect::route('repairorders.index');
	}

	/**
	 * Display the specified repairorder.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$repairorder = Repairorder::findOrFail($id);

		return View::make('repairorders.show', compact('repairorder'));
	}

	/**
	 * Show the form for editing the specified repairorder.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$repairorder = Repairorder::find($id);

		return View::make('repairorders.edit', compact('repairorder'));
	}

	/**
	 * Update the specified repairorder in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$repairorder = Repairorder::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Repairorder::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$repairorder->update($data);

		return Redirect::route('repairorders.index');
	}

	/**
	 * Remove the specified repairorder from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Repairorder::destroy($id);

		return Redirect::route('repairorders.index');
	}

}
