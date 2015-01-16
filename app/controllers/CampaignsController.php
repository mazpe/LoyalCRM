<?php

class CampaignsController extends \BaseController {

	/**
	 * Display a listing of campaigns
	 *
	 * @return Response
	 */
	public function index()
	{
		$campaigns = Campaign::all();

		return View::make('campaigns.index', compact('campaigns'));
	}

	/**
	 * Show the form for creating a new campaign
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
        return View::make('campaigns.create')
            ->with('dealer_options',$dealer_options)
            ->with('added_by_options',$added_by_options)
        ;
	}

	/**
	 * Store a newly created campaign in storage.
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
            return Redirect::to('campaigns/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $campaign = new Campaign;
            $campaign->name         = Input::get('name');
            $campaign->dealer_id    = Input::get('dealer_id');
            $campaign->added_by_id  = Input::get('added_by_id');
            $campaign->save();

            // redirect
            Session::flash('message', 'Successfully created Campaign!');
            return Redirect::to('campaigns');
        }

	}

	/**
	 * Display the specified campaign.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$campaign = Campaign::findOrFail($id);

		return View::make('campaigns.show', compact('campaign'));
	}

	/**
	 * Show the form for editing the specified campaign.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$campaign = Campaign::find($id);
        $dealer_options = array('' => 'Select a Dealer') +
            Dealer::lists('name', 'id');
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');

        return View::make('campaigns.edit')
            ->with('campaign', $campaign)
            ->with('dealer_options',$dealer_options)
            ->with('added_by_options',$added_by_options)
        ;

	}

	/**
	 * Update the specified campaign in storage.
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
            return Redirect::to('campaigns/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $campaign = Campaign::find($id);
            $campaign->name         = Input::get('name');
            $campaign->dealer_id    = Input::get('dealer_id');
            $campaign->added_by_id  = Input::get('added_by_id');
            $campaign->active       = Input::get('active');
            $campaign->save();

            // redirect
            Session::flash('message', 'Successfully updated campaign!');
            return Redirect::to('campaigns');
        }

	}

	/**
	 * Remove the specified campaign from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Campaign::destroy($id);

		return Redirect::route('campaigns.index');
	}

}
