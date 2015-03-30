<?php

class DirectionsController extends \BaseController {

	/**
	 * Display a listing of directions
	 *
	 * @return Response
	 */
	public function index()
	{
		//$directions = Direction::all();
        if (Auth::user()->hasRole('Agent')) {
            $dealers =  array('' => 'Select a Dealer') +
                Dealer::where('agent_id',Auth::user()->id)->lists('name', 'full_address');
        } else {
            $dealers =  array('' => 'Select a Dealer') +
            Dealer::lists('name', 'full_address'); 
        }

		return View::make('directions.index')
            ->with('dealers',$dealers)
            //->with(compact($dealers))
        ;
	}

    public function dealers()
    {

        $data           = Input::all();
        $campaign_id    = Input::get('campaign_id');
        $agent_id       = Input::get('agent_id');
        $month_id       = Input::get('month_id');
        $dealer_id      = Input::get('dealer_id');
        $map_dealers = array();

        foreach($data as $key => $value) {
            if (preg_match("/^dealer_id_/",$key)) {
                //$deal = Deal::find($value);
                if ($value) {
                array_push($map_dealers, $value);
                }
            }
        }
        //$directions = Direction::all();
        if (Auth::user()->hasRole('Agent')) {
            $dealers =  array('' => 'Select a Dealer') +
                Dealer::wherein('id',$map_dealers)
                ->where('agent_id',Auth::user()->id)
                ->lists('name', 'full_address')
            ;
        } else {
            $dealers =  array('' => 'Select a Dealer') +
            Dealer::wherein('id',$map_dealers)->lists('name', 'full_address');
        }

        return View::make('directions.index')
            ->with('dealers',$dealers)
            //->with(compact($dealers))
        ;


    }

	/**
	 * Show the form for creating a new direction
	 *
	 * @return Response
	 */
	public function create()
	{
        $dealer_options = array('' => 'Select a Dealer') +
            Dealer::lists('name', 'id');
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');

        // load the create form (app/views/dealers/create.blade.php)
        return View::make('directions.create')
            ->with('dealer_options',$dealer_options)
            ->with('added_by_options',$added_by_options)
        ;
	}

	/**
	 * Store a newly created direction in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'          => 'required',
            'dealer_id'     => 'required|numeric',
            'added_by_id'   => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('directions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $direction = new Direction;
            $direction->name         = Input::get('name');
            $direction->dealer_id    = Input::get('dealer_id');
            $direction->added_by_id  = Input::get('added_by_id');
            $direction->save();

            // redirect
            Session::flash('message', 'Successfully created Direction!');
            return Redirect::to('directions');
        }

	}

	/**
	 * Display the specified direction.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$direction = Direction::findOrFail($id);

		return View::make('directions.show', compact('direction'));
	}

	/**
	 * Show the form for editing the specified direction.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$direction = Direction::find($id);
        $dealer_options = array('' => 'Select a Dealer') +
            Dealer::lists('name', 'id');
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');

        return View::make('directions.edit')
            ->with('direction', $direction)
            ->with('dealer_options',$dealer_options)
            ->with('added_by_options',$added_by_options)
        ;

	}

	/**
	 * Update the specified direction in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
       // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'          => 'required',
            'dealer_id'     => 'required|numeric',
            'added_by_id'   => 'required|numeric',
            'active'   => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('directions/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $direction = Direction::find($id);
            $direction->name         = Input::get('name');
            $direction->dealer_id    = Input::get('dealer_id');
            $direction->added_by_id  = Input::get('added_by_id');
            $direction->active       = Input::get('active');
            $direction->save();

            // redirect
            Session::flash('message', 'Successfully updated direction!');
            return Redirect::to('directions');
        }

	}

	/**
	 * Remove the specified direction from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Direction::destroy($id);

		return Redirect::direction('directions.index');
	}

}
