<?php

class AssignmentsController extends \BaseController {

	/**
	 * Display a listing of assignments
	 *
	 * @return Response
	 */
	public function index()
    {

        $deals = Deal::all();
        $assignments = Assignment::all();
        $dealers = array('' => 'All') +
            Dealer::lists('name', 'id');
        $dispositions = array('' => 'All') +
            Disposition::lists('name', 'id');
        $campaigns = array('' => 'Select a Campaign') +
            Campaign::lists('name', 'id');
        $agents = array('' => 'Select an Agent') +
            User::lists('name', 'id');
        $months = array('' => 'Select a Month') +
            Month::lists('name', 'id');

        return View::make('assignments.index')
            ->with(compact('dealers'))
            ->with(compact('dispositions'))
            ->with(compact('deals'))
            ->with(compact('agents'))
            ->with(compact('campaigns'))
            ->with(compact('months'))
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

        return View::make('assigments.dealers')
            ->with('dealers',$dealers)
            //->with(compact($dealers))
        ;

    }


    
	/**
	 * Show the form for creating a new assignment
	 *
	 * @return Response
	 */
	public function create()
	{
        $dealers = array('' => 'Select a Dealer') +
            Dealer::lists('name', 'id');
        $added_by = array('' => 'Select a User') +
            User::lists('name', 'id');

		return View::make('assignments.create')
            ->with(compact('dealers'))
            ->with(compact('added_by'))
        ;
	}

	/**
	 * Store a newly created assignment in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Assignment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Assignment::create($data);

		return Redirect::route('assignments.index');
	}

	/**
	 * Display the specified assignment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$assignment = Assignment::findOrFail($id);

		return View::make('assignments.show', compact('assignment'));
	}

	/**
	 * Show the form for editing the specified assignment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$assignment = Assignment::find($id);

		return View::make('assignments.edit', compact('assignment'));
	}

	/**
	 * Update the specified assignment in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$assignment = Assignment::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Assignment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$assignment->update($data);

		return Redirect::route('assignments.index');
	}

	/**
	 * Remove the specified assignment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Assignment::destroy($id);

		return Redirect::route('assignments.index');
	}

    /**
     * Display a listing of assignments
     *
     * @return Response
     */
    public function dealer($id)
    {
        $assigned = Deal::whereNotNull('campaign_id')
                        ->where('dealer_id', $id)->get();
        $notAssigned = Deal::whereNull('campaign_id')
                        ->where('dealer_id', $id)->get();
        $assignments = Assignment::all();
        $dealers = array('' => 'All') +
            Dealer::lists('name', 'id');
        $dispositions = array('' => 'All') +
            Disposition::lists('name', 'id');
        $campaigns = array('' => 'Select a Campaign') +
            Campaign::lists('name', 'id');

        return View::make('assignments.dealer')
            ->with(compact('assigned'))
            ->with(compact('notAssigned'))
            ->with(compact('dealers'))
            ->with(compact('dispositions'))
            ->with(compact('campaigns'))
        ;
    }

    public function search()
    {

        // get parameters
        $dealer_id              = Input::get('dealer_id');
        $agent_id               = Input::get('agent_id');
        $month_id               = Input::get('month_id');
        $disposition_id         = Input::get('disposition_id');
        $purchase_date_from     = Input::get('purchase_date_from');
        $purchase_date_to       = Input::get('purchase_date_to');
        $lastvisit_date_from    = Input::get('lastvisit_from');
        $lastvisit_date_to      = Input::get('lastvisit_to');
        $miles_from             = Input::get('miles_from');
        $miles_to               = Input::get('miles_to');
        $sort_by                = Input::get('sort');
        $sort_direction         = Input::get('sort_direction');

        // let the searching begin
        $deals = Deal::query();
        if ($dealer_id) {
            $deals->where('dealer_id','=',$dealer_id);
        }
        if ($agent_id) {
            $deals->where('agent_id','=',$agent_id);
        }
        if ($month_id) {
            $deals->where('month_id','=',$month_id);
        }
        if ($disposition_id) {
            $deals->where('disposition_id','=',$disposition_id);
        }
        if ($purchase_date_from && $purchase_date_to) {
            $from = date( 'Y-m-d', strtotime($purchase_date_from));
            $to = date( 'Y-m-d', strtotime($purchase_date_to));
            $deals = $deals->whereBetween('purchase_date', array($from, $to));
        }
        if ($lastvisit_date_from && $lastvisit_date_to) {
            $from = date( 'Y-m-d', strtotime($lastvisit_date_from));
            $to = date( 'Y-m-d', strtotime($lastvisit_date_to));
            $deals = $deals->whereBetween('last_visit', array($from, $to));
        }
        if ($miles_from && $miles_to) {
            $from = $miles_from;
            $to = $miles_to;
            $deals = $deals->whereBetween('vehicle_mileage', array($from, $to));
        }
        if ($sort_by) {
            $deals->orderBy($sort_by,$sort_direction);
        }

        $deals_count = $deals->count();
        $deals = $deals->get();
        $assignments = Assignment::all();
        $dealers = array('' => 'All') +
            Dealer::lists('name', 'id');
        $dispositions = array('' => 'All') +
            Disposition::lists('name', 'id');
        $campaigns = array('' => 'All') +
            Campaign::lists('name', 'id');
        $agents = array('' => 'Select an Agent', 'null' => 'Clear' ) +
            User::lists('name', 'id');
        $months = array('' => 'Select an Month', 'null' => 'Clear' ) +
            Month::lists('name', 'id');

        return View::make('assignments.search')
            ->with(compact('deals_count'))
            ->with(compact('deals'))
            ->with(compact('dealers'))
            ->with(compact('dispositions'))
            ->with(compact('campaigns'))
            ->with(compact('agents'))
            ->with(compact('months'))
        ;

    }

    public function disposition()
    {
        $rules = array(
            'dealer_id'         => 'required|numeric',
            'disposition_id'    => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('dealers/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $dealer = Dealer::find($id);
            $dealer->dealer_group_id        = Input::get('dealer_group_id');
            $dealer->manufacture_id         = Input::get('manufacture_id');
            $dealer->name                   = Input::get('name');
            $dealer->address_1              = Input::get('address_1');
            $dealer->address_2              = Input::get('address_2');
            $dealer->city                   = Input::get('city');
            $dealer->state                  = Input::get('state');
            $dealer->zip                    = Input::get('zip');
            $dealer->phone                  = Input::get('phone');
            $dealer->fax                    = Input::get('fax');
            $dealer->email                  = Input::get('email');
            $dealer->contact                = Input::get('contact');
            $dealer->contact_phone          = Input::get('contact_phone');
            $dealer->contact_email          = Input::get('contact_email');
            $dealer->added_by_id            = Input::get('added_by_id');
            $dealer->active                 = Input::get('active');
            $dealer->save();

            // redirect
            Session::flash('message', 'Successfully updated Dealer!');
            return Redirect::to('dealers');
        }
    }

    public function setcampaign()
    {

        $data           = Input::all();
        $campaign_id    = Input::get('campaign_id');
        $agent_id       = Input::get('agent_id');
        $month_id       = Input::get('month_id');

        foreach($data as $key => $value) {
            if (preg_match("/^deal_id_/",$key)) {
                $deal = Deal::find($value);
                if ($campaign_id) { $deal->campaign_id  = $campaign_id; }  
                if ($agent_id) { 
                    if ($agent_id == "null") {
                        $deal->agent_id = null;
                    } else {
                        $deal->agent_id = $agent_id; 
                    }
                }
                if ($month_id) {
                    if ($month_id == "null") {
                        $deal->month_id = null;
                    } else {
                        $deal->month_id = $month_id;
                    }
                }

                $deal->save();

            }
        }

        Session::flash('message', 'Successfully updated Deals!');
        return Redirect::to('assignments'); 
    }


}
