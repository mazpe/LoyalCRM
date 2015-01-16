<?php

class AppointmentsController extends \BaseController {

	/**
	 * Display a listing of appointments
	 *
	 * @return Response
	 */
	public function index()
	{
		$appointments = Appointment::with('deal.dealer')
        
            ->get();


        ;

		return View::make('appointments.index', compact('appointments'));
	}

	/**
	 * Show the form for creating a new appointment
	 *
	 * @return Response
	 */
	public function create()
	{
        $deals = array('' => 'Select a Deal') +
            Deal::lists('name', 'id');
        $added_by = array('' => 'Select a User') +
            User::lists('name', 'id');

		return View::make('appointments.create')
            ->with(compact('deals'))
            ->with(compact('added_by'))
        ;
	}

	/**
	 * Store a newly created appointment in storage.
	 *
	 * @return Response
	 */
	public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'deal_id'       => 'required|numeric',
            'appointment_date'       => 'required',
            'added_by_id' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('appointments/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $appointment = new Appointment;
            $appointment->deal_id            = Input::get('deal_id');
            $appointment->appointment_date   = Input::get('appointment_date');
            $appointment->added_by_id    = Input::get('added_by_id');
            $appointment->active         = Input::get('active');
            $appointment->save();

            // redirect
            Session::flash('message', 'Successfully created Appointment!');
            return Redirect::to('appointments');
        }
    }

	/**
	 * Display the specified appointment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$appointment = Appointment::findOrFail($id);

		return View::make('appointments.show', compact('appointment'));
	}

	/**
	 * Show the form for editing the specified appointment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$appointment = Appointment::find($id);

		return View::make('appointments.edit', compact('appointment'));
	}

	/**
	 * Update the specified appointment in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$appointment = Appointment::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Appointment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$appointment->update($data);

		return Redirect::route('appointments.index');
	}

	/**
	 * Remove the specified appointment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Appointment::destroy($id);

		return Redirect::route('appointments.index');
	}

}
