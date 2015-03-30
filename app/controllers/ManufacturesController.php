<?php

class ManufacturesController extends \BaseController {

    /**
     * Display a listing of manufactures
     *
     * @return Response
     */
    public function index()
    {
        $manufactures = Manufacture::all();

        return View::make('manufactures.index', compact('manufactures'));
    }

    /**
     * Show the form for creating a new manufacture
     *
     * @return Response
     */
    public function create()
    {
        return View::make('manufactures.create');

    }

    /**
     * Store a newly created manufacture in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name'          => 'required',
            'active'   => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::to('manufactures/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }
        else
        {
            $manufacture = new Manufacture;
            $manufacture->name          = Input::get('name');
            $manufacture->added_by_id   = Auth::user()->id;
            $manufacture->active        = Input::get('active');
            $manufacture->save();

            // redirect
            Session::flash('message', 'Successfully created Manufacture!');
            return Redirect::to('manufactures');
        }

        return Redirect::route('manufactures.index');
    }

    /**
     * Display the specified manufacture.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $manufacture = Manufacture::findOrFail($id);
        $dealers = Dealer::where('manufacture_id','=',$id)->get();

        return View::make('manufactures.show')
            ->with(compact('dealers'))
            ->with(compact('manufacture'))
        ;
    }

    /**
     * Show the form for editing the specified manufacture.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $manufacture = Manufacture::find($id);

        // load the create form (app/views/dealers/create.blade.php)
        return View::make('manufactures.edit')
            ->with('manufacture',$manufacture)
        ;
    }

    /**
     * Update the specified manufacture in storage.
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
            return Redirect::to('manufactures/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $manufacture = Manufacture::find($id);
            $manufacture->name          = Input::get('name');
            $manufacture->added_by_id   = Auth::user()->id;
            $manufacture->active        = Input::get('active');
            $manufacture->save();

            // redirect
            Session::flash('message', 'Successfully updated Manufacture!');
            return Redirect::to('manufactures');
        }

    }

    /**
     * Remove the specified manufacture from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Manufacture::destroy($id);
        return Redirect::route('manufactures.index');
    }

}
