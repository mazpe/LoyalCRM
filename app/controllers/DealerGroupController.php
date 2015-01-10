<?php

class DealerGroupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        // get all the dealergroups
        $dealergroups = DealerGroup::all();
        $dg_count = $dealergroups->count();

        // load the view and pass the dealergroups 
        return View::make('dealergroups.index')
            ->with('dealergroups', $dealergroups);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        // load the create form (app/views/dealers/create.blade.php)
        return View::make('dealergroups.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('dealergroups/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $dealergroup = new DealerGroup;
            $dealergroup->name          = Input::get('name');
            $dealergroup->address_1     = Input::get('address_1');
            $dealergroup->address_2     = Input::get('address_2');
            $dealergroup->city          = Input::get('city');
            $dealergroup->state         = Input::get('state');
            $dealergroup->zip           = Input::get('zip');
            $dealergroup->phone         = Input::get('phone');
            $dealergroup->fax           = Input::get('fax');
            $dealergroup->email         = Input::get('email');
            $dealergroup->contact       = Input::get('contact');
            $dealergroup->contact_phone = Input::get('contact_phone');
            $dealergroup->contact_email = Input::get('contact_email');
            $dealergroup->added_by_id   = Auth::user()->id;
            $dealergroup->active        = Input::get('active');
            $dealergroup->save();

            // redirect
            Session::flash('message', 'Successfully created Dealer Group!');
            if (Auth::user()->hasRole('Agent')) {
                return Redirect::to('agents/'.Auth::user()->id.'/leads');
            } else {
                return Redirect::to('dealergroups');
            }

        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        // get the dealergroup
        $dealergroup = DealerGroup::find($id);
        $dealers = Dealer::where('dealer_group_id','=',$id)->get();

        // show the view and pass the dealergroup to it
        return View::make('dealergroups.show')
            ->with('dealergroup', $dealergroup)
            ->with(compact('dealers'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        // get the dealergroup
        $dealergroup = DealerGroup::find($id);
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');


        // show the edit form and pass the dealergroup
        return View::make('dealergroups.edit')
            ->with('dealergroup', $dealergroup)
            ->with('added_by_options', $added_by_options);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		//
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'active' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('dealergroups/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $dealergroup = DealerGroup::find($id);
            $dealergroup->name          = Input::get('name');
            $dealergroup->address_1     = Input::get('address_1');
            $dealergroup->address_2     = Input::get('address_2');
            $dealergroup->city          = Input::get('city');
            $dealergroup->state         = Input::get('state');
            $dealergroup->zip           = Input::get('zip');
            $dealergroup->phone         = Input::get('phone');
            $dealergroup->fax           = Input::get('fax');
            $dealergroup->email         = Input::get('email');
            $dealergroup->contact       = Input::get('contact');
            $dealergroup->contact_phone = Input::get('contact_phone');
            $dealergroup->contact_email = Input::get('contact_email');
            $dealergroup->added_by_id   = Auth::user()->id;
            $dealergroup->active        = Input::get('active');
            $dealergroup->save();

            // redirect
            Session::flash('message', 'Successfully updated Dealer Group!');
            if (Auth::user()->hasRole('Agent')) {
                return Redirect::to('agents/'.Auth::user()->id.'/leads');
            } else {
                return Redirect::to('dealergroups');
            }
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        // delete
        $dealergroup = DealerGroup::find($id);
        $dealergroup->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Dealer Group!');
        return Redirect::to('dealergroups');
	}


}
