<?php

class RolesController extends \BaseController {

	/**
	 * Display a listing of roles
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();

		return View::make('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new role
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roles.create');
	}

	/**
	 * Store a newly created role in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'name'          => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('roles/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $role = new Role;
            $role->name         = Input::get('name');
            $role->save();

            // redirect
            Session::flash('message', 'Successfully created Role!');
            return Redirect::to('roles');
        }

	}

	/**
	 * Display the specified role.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        // get the user
        $role = Role::find($id);
        $permissionroles = PermissionRole::where('role_id','=',$id)->get();
        $permissions = array('' => 'Select a Permission') +
            Permission::lists('display_name', 'id');

        // show the view and pass the user to it
        return View::make('roles.show')
            ->with('role',$role)
            ->with('permissionroles',$permissionroles)
            ->with('permissions',$permissions)
        ;


	}

	/**
	 * Show the form for editing the specified role.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);

		return View::make('roles.edit', compact('role'));
	}

	/**
	 * Update the specified role in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = Role::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Role::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$role->update($data);

		return Redirect::route('roles.index');
	}

	/**
	 * Remove the specified role from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Role::destroy($id);

		return Redirect::route('roles.index');
	}

    public function addpermission()
    {
        $id = Input::get('role_id');

       // validate
        $rules = array(
            'role_id'   => 'required|numeric',
            'permission_id'   => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('roles/' . $id )
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $permissionrole               = new PermissionRole;
            $permissionrole->role_id      = $id;
            $permissionrole->permission_id      = Input::get('permission_id');
            $permissionrole->save();

            // redirect
            Session::flash('message', 'Successfully added Permission!');
            return Redirect::to('roles/'. $id);

        }

    }


    //public function deletepermission($user_id,$assigned_permission_id)
    public function deletepermission($permission_role_id)
    {
        //
        // delete
        $rolepermission = PermissionRole::find($permission_role_id);
        $rolepermission->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the roles Permission!');
        return Redirect::to('roles');
    }



}
