<?php

//class UserController extends Controller
class UserController extends BaseController
{

    public function index() {
        $users = User::all();

        return View::make('users.index')
            ->with(compact('users'))
        ;
    }

    public function create()
    {
        //
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');

        // load the create form (app/views/users/create.blade.php)
        return View::make('users.create')
            ->with('added_by_options',$added_by_options)
        ;
    }

    public function store()
    {
        //
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'username'   => 'required|unique:users',
            'password'   => 'required',
            'name'       => 'required',
            'initials'   => 'required',
            'email'      => 'required|email|unique:users'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
            ;
        } else {
            // store
            $user = new User;
            $user->username         = Input::get('username');
            $user->password         = Hash::make(Input::get('password'));
            $user->name             = Input::get('name');
            $user->initials         = Input::get('initials');
            $user->address_1        = Input::get('address_1');
            $user->address_2        = Input::get('address_2');
            $user->city             = Input::get('city');
            $user->state            = Input::get('state');
            $user->zip              = Input::get('zip');
            $user->phone            = Input::get('phone');
            $user->fax              = Input::get('fax');
            $user->email            = Input::get('email');
            $user->active           = Input::get('active');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully created User!');
            return Redirect::to('users');

        }
    }

    public function show($id)
    {
        //
        // get the user
        $user = User::find($id);
        $assignedroles = AssignedRole::where('user_id','=',$id)->get();
        $roles = array('' => 'Select a Role') +
            Role::lists('name', 'id');

        // show the view and pass the user to it
        return View::make('users.show')
            ->with('user', $user)
            ->with('assignedroles', $assignedroles)
            ->with('roles', $roles)
        ;
    }

    public function edit($id)
    {
        //
        // get the user
        $user = User::find($id);

        // load the create form (app/views/users/create.blade.php)
        return View::make('users.edit')
            ->with('user', $user);
    }

    public function update($id)
    {
       // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'username' => 'required',
            'name'     => 'required',
            'initials' => 'required',
            'email'    => 'required',
            'active'   => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = User::find($id);
            $user->name           = Input::get('name');
            $user->initials       = Input::get('initials');
            $user->address_1      = Input::get('address_1');
            $user->address_2      = Input::get('address_2');
            $user->city           = Input::get('city');
            $user->state          = Input::get('state');
            $user->zip            = Input::get('zip');
            $user->phone          = Input::get('phone');
            $user->fax            = Input::get('fax');
            $user->email          = Input::get('email');
            $user->active           = Input::get('active');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated User!');
            return Redirect::to('users');
        }

    }

    public function destroy($id)
    {
        //
        // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the User!');
        return Redirect::to('users');
    }


    public function addrole()
    {
        $id = Input::get('user_id');
        
       // validate
        $rules = array(
            'user_id'   => 'required|numeric',
            'role_id'   => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/' . $id )
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $assignedrole               = new AssignedRole;
            $assignedrole->user_id      = $id;
            $assignedrole->role_id      = Input::get('role_id');
            $assignedrole->save();

            // redirect
            Session::flash('message', 'Successfully added Role!');
            return Redirect::to('users/'. $id);
            
        }

    }

    //public function deleterole($user_id,$assigned_role_id)
    public function deleterole($assigned_role_id)
    {
        //
        // delete
        $assignedrole = AssignedRole::find($assigned_role_id);
        $assignedrole->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Assigned Role!');
        return Redirect::to('users');
    }


    public function login()
    {
        if ($this->isPostRequest()) {
            $validator = $this->getLoginValidator();

            if ($validator->passes()) {
                $credentials = $this->getLoginCredentials();

                if (Auth::attempt($credentials)) {
                    return Redirect::route("user/profile");
                }

                return Redirect::back()->withErrors([
                        "password" => ["Credentials invalid."]
                        ]);
            } else {
                return Redirect::back()
                    ->withInput()
                    ->withErrors($validator);
            }
        }

        return View::make("user/login");
    }

public function logout()
{
  Auth::logout();
  
  return Redirect::route("user/login");
}

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    protected function getLoginValidator()
    {
        return Validator::make(Input::all(), [
                "username" => "required",
                "password" => "required"
                ]);
    }

    protected function getLoginCredentials()
    {
        return [
            "username" => Input::get("username"),
            "password" => Input::get("password")
                ];
    }

    public function profile()
    {
        return View::make("user/profile");
    }

    public function request()
    {
        if ($this->isPostRequest()) {
            $response = $this->getPasswordRemindResponse();

            if ($this->isInvalidUser($response)) {
                return Redirect::back()
                    ->withInput()
                    ->with("error", Lang::get($response));
            }

            return Redirect::back()
                ->with("status", Lang::get($response));
        }

        return View::make("user/request");
    }

    protected function getPasswordRemindResponse()
    {
        return Password::remind(Input::only("email"));
    }

    protected function isInvalidUser($response)
    {
        return $response === Password::INVALID_USER;
    }

    public function reset($token)
    {
        if ($this->isPostRequest()) {
            $credentials = Input::only(
                    "email",
                    "password",
                    "password_confirmation"
                    ) + compact("token");

            $response = $this->resetPassword($credentials);

            if ($response === Password::PASSWORD_RESET) {
                return Redirect::route("user/profile");
            }

            return Redirect::back()
                ->withInput()
                ->with("error", Lang::get($response));
        }

        return View::make("user/reset", compact("token"));
    }

    protected function resetPassword($credentials)
    {
        return Password::reset($credentials, function($user, $pass) {
                $user->password = Hash::make($pass);
                $user->save();
                });
    }

}
