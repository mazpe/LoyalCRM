<?php

use Carbon\Carbon;

class DealerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        if (Auth::user()->hasRole('Agent')) {
            return Redirect::to('agents/' .
                Auth::user()->id.'/leads'
            );
        }

        $agent = User::find(Auth::user()->id);

        // get all the dealers
        $contact_types = array('' => 'Select a Call Type') +
            ContactType::lists('name', 'id');
        $stages = array('' => 'Select a Stage') +
            Stage::lists('name', 'id');
        $stages_counter = Stage::select('stages.id as id','stages.name as name',
                'stages.description as description',
                DB::raw('count(*) as count'))
            ->leftjoin('dealers','stages.id','=','dealers.stage_id')
            ->groupBy('stages.id')
            ->orderBy('stages.sorting')
            ->get()
        ;
        $dealers = Dealer::with('manufacture')
            ->with('dealergroup')
            ->with('agent')
        ;
        $dealers = Dealer::select('dealers.name as dealer',
                'dealers.id as dealer_id', 'dealer_groups.name as dealergroup',
                'manufactures.name as manufacture','stages.name as stage',
                'stages.description as stage_description',
                'next_contact_date', 'users.name as strategist',
                'contact_types.name as next_contact_type'
            )
            ->with('dealergroup')
            ->with('manufacture')
            ->leftjoin('dealer_groups',
                'dealers.dealer_group_id','=','dealer_groups.id')
            ->leftjoin('users',
                'dealers.agent_id','=','users.id')
            ->leftjoin('manufactures',
                'dealers.manufacture_id','=','manufactures.id')
            ->leftjoin('stages',
                'dealers.stage_id','=','stages.id')
            ->leftjoin('contact_types',
                'dealers.next_contact_type_id','=','contact_types.id')
            ->orderByRaw('dealers.next_contact_date IS NOT NULL DESC,
                dealers.next_contact_date')
            ->orderBy('stages.sorting')
            ->orderBy('dealer_groups.name')
            ->orderBy('dealers.name')
            ->limit('500')
        ;
        $dealers_count = $dealers->count();
        $dealers = $dealers->get();

        $limit = array('' => 'Select a Limit',
            'all' => 'All', '50'=>'50','100'=>'100','500'=>'500','1000'=>'1000')
         ; 

        $agents = array('' => 'Select an Agent') +
            User::lists('name', 'id');
        $dealer_groups = array('' => 'Select an Dealer Group') +
            DealerGroup::lists('name', 'id');
        $manufactures = array('' => 'Select an Manufacture') +
            Manufacture::lists('name', 'id');

        // load the view and pass the dealers 
        return View::make('dealers.index')
            ->with('dealers', $dealers)
            ->with('agent', $agent)
            ->with('limit', $limit)
            ->with('agents', $agents)
            ->with('stages', $stages)
            ->with('dealer_groups', $dealer_groups)
            ->with('manufactures', $manufactures)
            ->with('stages_counter', $stages_counter)
            ->with('dealers_count', $dealers_count)
        ;
	}

	public function create()
	{
        $dealer_groups = array('' => 'Select a Dealer Group') + 
            DealerGroup::lists('name', 'id');
        $manufactures = array('' => 'Select a Manufacture') +
            Manufacture::lists('name', 'id');
        $agents = array('' => 'Select a Strategist') +
            User::lists('name', 'id');

        // load the create form (app/views/dealers/create.blade.php)
        return View::make('dealers.create')
            ->with('dealer_groups',$dealer_groups)
            ->with('manufactures',$manufactures)
            ->with('agents',$agents)
        ;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            //'dealer_group_id'   => 'required|numeric',
            //'manufacture_id'    => 'required|numeric',
            'name'              => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('dealers/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $agent_id                   = Input::get('agent_id');
            $dealer = new Dealer;
            $full_address = Input::get('address_1'). ', '. 
                Input::get('city'). ', '. Input::get('state'). ', '. 
                Input::get('zip');
            if (Input::get('dealer_group_id')) {
                $dealer->dealer_group_id    = Input::get('dealer_group_id');
            }
            if (Input::get('manufacture_id')) {
                $dealer->manufacture_id     = Input::get('manufacture_id');
            }
            if ($agent_id == "")
                { $dealer->agent_id = null; }
            else { $dealer->agent_id = $agent_id; }
            $dealer->name               = Input::get('name');
            $dealer->address_1          = Input::get('address_1');
            $dealer->address_2          = Input::get('address_2');
            $dealer->city               = Input::get('city');
            $dealer->state              = Input::get('state');
            $dealer->zip                = Input::get('zip');
            $dealer->full_address       = $full_address;
            $dealer->phone              = Input::get('phone');
            $dealer->fax                = Input::get('fax');
            $dealer->email              = Input::get('email');
            $dealer->website            = Input::get('website');
            $dealer->owner              = Input::get('owner');
            $dealer->owner_phone        = Input::get('owner_phone');
            $dealer->owner_email        = Input::get('owner_email');
            $dealer->general_manager    = Input::get('general_manager');
            $dealer->general_manager_phone    
                = Input::get('general_manager_phone');
            $dealer->general_manager_email    
                = Input::get('general_manager_email');
            $dealer->service_manager    = Input::get('service_manager');
            $dealer->service_manager_phone    
                = Input::get('service_manager_phone');
            $dealer->service_manager_email    
                = Input::get('service_manager_email');
            $dealer->note               = Input::get('note');
            $dealer->added_by_id        = Auth::user()->id;
            $dealer->active             = Input::get('active');
            $dealer->save();

            // redirect
            Session::flash('message', 'Successfully created Dealer!');
            return Redirect::to('agents/' . Auth::user()->id.'/leads');
        }
	}

    public function show($id)
    {
        $dealer = Dealer::findOrFail($id);
        $contact_types = array('' => 'Select a Call Type') +
            ContactType::lists('name', 'id');
        $stages = array('' => 'Select a Stage') +
            Stage::lists('name', 'id');

        $notes = CallRecord::where('dealer_id','=',$id)
            ->orderBy('created_at','DESC')
            ->get();
        


        return View::make('dealers.show')
            ->with(compact('dealer'))
            ->with(compact('contact_types'))
            ->with(compact('stages'))
            ->with(compact('notes'))
          
            
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */    

    public function note_edit($id,$note_id)
    {
     
     $note = CallRecord::find($note_id);
     $contact_types = array('' => 'Select a Call Type') +
            ContactType::lists('name', 'id');
     $stages = array('' => 'Select a Stage') +
            Stage::lists('name', 'id');

     return View::make('dealers.edit_note')
           ->with('note',$note)
           ->with('contact_types',$contact_types)
           ->with('stages',$stages)
            ->with('dealer_id',$id)
           ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */   

    public function note_update($id,$note_id)
    {

       $note = CallRecord::find($note_id);
       $note->last_contact_date = Input::get('last_contact_date');
       $note->last_contact_type_id = Input::get('last_contact_type');
       $note->last_contact_note = Input::get('last_contact_note');
       $note->last_call = Input::get('last_call');
       $note->stage_id = Input::get('stage');
       $note->edited_by_id = Auth::user()->id;
       //$note->updated_at = date("m-d-Y  g:i A");
       $note->save();

       // redirect
        Session::flash('message', 'Successfully edited Note!');
            //if (Auth::user()->hasRole('Agent')) {
        return Redirect::to('dealers/'. $id);
            //}


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
        // get the dealer
        $dealer = Dealer::find($id);
        $dealer_groups = array('' => 'Select a Dealer Group', '0' => 'Empty') +
            DealerGroup::lists('name', 'id');
        $manufactures = array('' => 'Select a Manufacture') +
            Manufacture::lists('name', 'id');
        $agents = array('' => 'Select an Agent', '0' => 'Empty') + 
            User::lists('name', 'id');

        // load the create form (app/views/dealers/create.blade.php)
        return View::make('dealers.edit')
            ->with('dealer',$dealer)
            ->with('dealer_groups',$dealer_groups)
            ->with('manufactures',$manufactures)
            ->with('agents',$agents)
        ;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $dealer_group_id        = Input::get('dealer_group_id');
        $agent_id               = Input::get('agent_id_1');
        $agent_id_2             = Input::get('agent_id_2');
        $agent_id_3             = Input::get('agent_id_3');
        $agent_id_4             = Input::get('agent_id_4');

     /*   var_dump($agent_id);
        var_dump($agent_id_2);
        var_dump($agent_id_3);
        var_dump($agent_id_4);
        die();*/
        		//
        // validate
        // read more on validation at http://laravel.com/docs/validation
        


        $rules = array(
            //'dealer_group_id'   => 'required|numeric',
            //'manufacture_id'    => 'required|numeric',
            'name'              => 'required',
            'active'            => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);


        $array = Array();

    if ($agent_id != ""){
        $array[count($array)] = $agent_id;
    }
    if($agent_id_2 != ""){
        $array[count($array)] = $agent_id_2;
    }
    if($agent_id_3 != ""){
        $array[count($array)] = $agent_id_3;
    }
    if($agent_id_4 != ""){
        $array[count($array)] = $agent_id_4;
    }

   
   $error = 0;

    if (count($array) >1){
    for ($i = 0; $i < count($array); $i++) {
        for ( $x = 0; $x < count($array); $x++) {
           if(($i != $x) && $array[$i]==$array[$x]){
               $error=$error+1;
           }
        }
    }
}
        // process the login
         $msg = "You can't select the same agent twice";
         if ($validator->fails() || $error > 0) {
            return Redirect::to('dealers/' . $id . '/edit')
                ->withErrors($validator,$msg)
                ->withInput(Input::except('password'))
                ;
        } else {
            // store
            $dealer = Dealer::find($id);
            $full_address = Input::get('address_1'). ', '. 
                Input::get('city'). ', '. 
                Input::get('state'). ', '. Input::get('zip');
            if (Input::get('dealer_group_id')) {
                $dealer->dealer_group_id    = Input::get('dealer_group_id');
            }
            if (Input::get('manufacture_id')) {
                $dealer->manufacture_id     = Input::get('manufacture_id');
            }
            if ($agent_id == "") 
                { $dealer->agent_id = null; }
            else
                {$dealer->agent_id   = $agent_id;} 
            if ($agent_id_2 == "")
                { $dealer->agent_id_2 = null;}
            else
                {$dealer->agent_id_2 = $agent_id_2;}
            if ($agent_id_3 == "")
                { $dealer->agent_id_3 = null;}
            else
                {$dealer->agent_id_3 = $agent_id_3;}
            if ($agent_id_4 == "")
                { $dealer->agent_id_4 = null;}
            else 
                {$dealer->agent_id_4 = $agent_id_4;}

            $dealer->name               = Input::get('name');
            $dealer->address_1          = Input::get('address_1');
            $dealer->address_2          = Input::get('address_2');
            $dealer->city               = Input::get('city');
            $dealer->state              = Input::get('state');
            $dealer->zip                = Input::get('zip');
            $dealer->full_address       = $full_address;
            $dealer->phone              = Input::get('phone');
            $dealer->fax                = Input::get('fax');
            $dealer->email              = Input::get('email');
            $dealer->website            = Input::get('website');
            $dealer->owner              = Input::get('owner');
            $dealer->owner_phone        = Input::get('owner_phone');
            $dealer->owner_email        = Input::get('owner_email');
            $dealer->general_manager    = Input::get('general_manager');
            $dealer->general_manager_phone
                = Input::get('general_manager_phone');
            $dealer->general_manager_email
                = Input::get('general_manager_email');
            $dealer->service_manager    = Input::get('service_manager');
            $dealer->service_manager_phone
                = Input::get('service_manager_phone');
            $dealer->service_manager_email
                = Input::get('service_manager_email');
            $dealer->note               = Input::get('note');
            $dealer->updated_by_id      = Auth::user()->id;
            $dealer->active             = Input::get('active');
            $dealer->save();
            $error = 0;
            // redirect
            Session::flash('message', 'Successfully updated Dealer!');
            //if (Auth::user()->hasRole('Agent')) {
                return Redirect::to('dealers/'. $id);
            //}
 
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
        $dealer = Dealer::find($id);
        $dealer->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Dealer!');
        return Redirect::to('agents/'. Auth::user()->id .'/leads');
	}

    public function disposition()
    {
        $rules = array(
            'dealer_id'         => 'required|numeric',
        );

        if (Input::get('last_contact_type_id')) {
            $rules_additions = array( 'last_contact_date'  => 'required');
            $rules = array_merge((array)$rules, (array)$rules_additions);
        }

        if (Input::get('last_contact_date')) {
            $rules_additions = array( 'last_contact_type_id'  => 'required');
            $rules = array_merge((array)$rules, (array)$rules_additions);
        }

        if (Input::get('next_contact_type_id')) {
            $rules_additions = array( 'next_contact_date'  => 'required');
            $rules = array_merge((array)$rules, (array)$rules_additions);
        }

        if (Input::get('next_contact_date')) {
            $rules_additions = array( 'next_contact_type_id'  => 'required');
            $rules = array_merge((array)$rules, (array)$rules_additions);
        }

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        $id                     = Input::get('dealer_id');
        $agent_id               = Auth::user()->id;
        $last_contact_date      = Input::get('last_contact_date');
        $last_contact_type_id   = Input::get('last_contact_type_id');
        $last_contact_note      = Input::get('last_contact_note');
        $next_contact_date      = Input::get('next_contact_date');
        $next_contact_type_id   = Input::get('next_contact_type_id');


        if ($validator->fails()) {
            return Redirect::to( '/dealers/'. $id )
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            if (Input::get('last_call') == "yes") { $last_call = 1; } 
            else { $last_call = 0; }
            $dealer = Dealer::find($id);
            $dealer->last_call          = $last_call;
            $dealer->last_contact_note  = $last_contact_note;
            $dealer->next_contact_note  = Input::get('next_contact_note');
            $dealer->note               = Input::get('note');
            if (Input::get('stage_id')) {
                $dealer->stage_id          = Input::get('stage_id');
            }
            if ($last_contact_date && $last_contact_type_id) {
                $dealer->last_contact_date      = $last_contact_date;
                $dealer->last_contact_type_id   = $last_contact_type_id;
            } else {
                $dealer->last_contact_date      = null;
                $dealer->last_contact_type_id   = null;
            }
            if ($next_contact_date && $next_contact_type_id) {
                $dealer->next_contact_date      = $next_contact_date;
                $dealer->next_contact_type_id   = $next_contact_type_id;
            } else {
                $dealer->next_contact_date      = null;
                $dealer->next_contact_type_id   = null;
            }
            $dealer->save();

            if (Input::get('update_history') == 'yes' && $last_contact_date 
                && $last_contact_type_id) 
            {
                // call record
                $call_records = new CallRecord;
                $call_records->agent_id                 = Auth::user()->id;
                $call_records->dealer_id                = $id;
                if ($last_contact_date && $last_contact_type_id) {
                    $call_records->last_contact_date    = $last_contact_date;
                    $call_records->last_contact_type_id = $last_contact_type_id;
                }
                $call_records->last_contact_note        = $last_contact_note;
                $call_records->last_call                = $last_call;
                $call_records->stage_id                
                    = Input::get('stage_id');
                $call_records->added_by_id              = Auth::user()->id;
                $call_records->save();

            }

            Session::flash('message', 'Successfully updated Disposition!');

            if (Input::get('SaveAndStay')) {
                return Redirect::to('/dealers/'. $id);
            }

            if (Input::get('SaveAndClose')) {
                return Redirect::to('agents/' . Auth::user()->id.'/leads');
            }
        }
    }


}
