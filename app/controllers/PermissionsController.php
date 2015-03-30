<?php

class PermissionsController extends \BaseController {

	/**
	 * Display a listing of permissions
	 *
	 * @return Response
	 */
	public function index()
	{
		$permissions = Permission::all();

		return View::make('permissions.index', compact('permissions'));
	}

	/**
	 * Show the form for creating a new permission
	 *
	 * @return Response
	 */
	public function create()
	{
        $added_by = array('' => 'Select a User') +
            User::lists('name', 'id');

        // load the create form (app/views/dealers/create.blade.php)
        return View::make('permissions.create')
            ->with('added_by',$added_by)
        ;


		return View::make('permissions.create');
	}

	/**
	 * Store a newly created permission in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'name'          => 'required',
            'added_by_id'   => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('permissions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $permission = new Permission;
            $permission->name         = Input::get('name');
            $permission->added_by_id  = Input::get('added_by_id');
            $permission->save();

            // redirect
            Session::flash('message', 'Successfully created Permission!');
            return Redirect::to('permissions');
        }

	}

	/**
	 * Display the specified permission.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$permission = Permission::findOrFail($id);

		return View::make('permissions.show', compact('permission'));
	}

	/**
	 * Show the form for editing the specified permission.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$permission = Permission::find($id);

		return View::make('permissions.edit', compact('permission'));
	}

	/**
	 * Update the specified permission in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$permission = Permission::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Permission::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$permission->update($data);

		return Redirect::route('permissions.index');
	}

	/**
	 * Remove the specified permission from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Permission::destroy($id);

		return Redirect::route('permissions.index');
	}

}
