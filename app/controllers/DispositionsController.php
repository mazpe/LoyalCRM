<?php

class DispositionsController extends \BaseController {

	/**
	 * Display a listing of dispositions
	 *
	 * @return Response
	 */
	public function index()
	{
		$dispositions = Disposition::all();

		return View::make('dispositions.index', compact('dispositions'));
	}

	/**
	 * Show the form for creating a new disposition
	 *
	 * @return Response
	 */
	public function create()
	{
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');

		return View::make('dispositions.create')
            ->with('added_by_options',$added_by_options)
        ;
	}

	/**
	 * Store a newly created disposition in storage.
	 *
	 * @return Response
	 */
	public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'added_by_id' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('dispositions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $disposition = new Disposition;
            $disposition->name           = Input::get('name');
            $disposition->added_by_id    = Input::get('added_by_id');
            $disposition->active         = Input::get('active');
            $disposition->save();

            // redirect
            Session::flash('message', 'Successfully created Disposition!');
            return Redirect::to('dispositions');
        }
    }


	/**
	 * Display the specified disposition.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$disposition = Disposition::findOrFail($id);


		return View::make('dispositions.show', compact('disposition'));
	}

	/**
	 * Show the form for editing the specified disposition.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');

		$disposition = Disposition::find($id);

		return View::make('dispositions.edit')
            ->with(compact('disposition'))
            ->with('added_by_options',$added_by_options)
            
        ;
	}

	/**
	 * Update the specified disposition in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'              => 'required',
            'added_by_id'       => 'required|numeric',
            'active'            => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('dispositions/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $disposition = Disposition::find($id);
            $disposition->name           = Input::get('name');
            $disposition->added_by_id    = Input::get('added_by_id');
            $disposition->active         = Input::get('active');
            $disposition->save();

            // redirect
            Session::flash('message', 'Successfully updated Disposition!');
            return Redirect::to('dispositions');
        }
    }
	}

	/**
	 * Remove the specified disposition from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Disposition::destroy($id);

		return Redirect::route('dispositions.index');
	}

}
