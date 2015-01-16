<?php

use Carbon\Carbon;

class DealsController extends \BaseController {

	/**
	 * Display a listing of deals
	 *
	 * @return Response
	 */
	public function index()
	{
		$deals = Deal::all();

		return View::make('deals.index', compact('deals'));
	}

	/**
	 * Show the form for creating a new deal
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('deals.create');
	}

	/**
	 * Store a newly created deal in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Deal::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Deal::create($data);

		return Redirect::route('deals.index');
	}

	/**
	 * Display the specified deal.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$deal = Deal::findOrFail($id);
        $dispositions = array('' => 'Select a Disposition') +
            Disposition::lists('name', 'id');
        $campaigns = array('' => 'Select a Campaign') +
            Campaign::lists('name', 'id');
        $dispositions_rp = Disposition::all();
        $notes = CallRecord::where('deal_id','=',$id)
            ->orderBy('created_at','DESC')->get();

        $dt = Carbon::now();
        $purchase_date = Carbon::createFromTimeStamp(
            strtotime($deal->purchase_date)
        );
        $service_date = Carbon::createFromTimeStamp(
            strtotime($deal->last_visit)
        );
        $disposition = CallRecord::where('deal_id','=',$id)
            ->orderBy('created_at','DESC')->first();

		return View::make('deals.deal')
            ->with(compact('notes'))
            ->with(compact('deal'))
            ->with(compact('campaigns'))
            ->with(compact('disposition'))
            ->with(compact('dispositions'))
            ->with(compact('dispositions_rp'))
            ->with(compact('purchase_date'))
            ->with(compact('service_date')) 
            ->with('dealer_id', $deal->dealer_id)
        ;
	}

	public function edit($id)
	{
		$deal = Deal::find($id);
        $dealers = array('' => 'Select a Dealer') +
            Dealer::lists('name', 'id');
        $added_by = array('' => 'Select a User') +
            User::lists('name', 'id');
        $dispositions = array('' => 'Select a Disposition') +
            Disposition::lists('name', 'id');

		return View::make('deals.edit')
            ->with(compact('deal'))
            ->with(compact('added_by'))
            ->with(compact('dealers'))
            ->with(compact('dispositions'))
        ;
	}

	/**
	 * Update the specified deal in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'dealer_id'         => 'required|numeric',
            'name'              => 'required',
            'email'             => 'required|email',
            'active'            => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('deals/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $deal = Deal::find($id);
            $deal->dealer_id            = Input::get('dealer_id');
            $deal->name                 = Input::get('name');
            $deal->address_1            = Input::get('address_1');
            $deal->address_2            = Input::get('address_2');
            $deal->city                 = Input::get('city');
            $deal->state                = Input::get('state');
            $deal->zip                  = Input::get('zip');
            $deal->phone                = Input::get('phone');
            $deal->fax                  = Input::get('fax');
            $deal->email                = Input::get('email');
            $deal->stock_number         = Input::get('stock_number');
            $deal->vehicle_year         = Input::get('vehicle_year');
            $deal->vehicle_make         = Input::get('vehicle_make');
            $deal->vehicle_model        = Input::get('vehicle_model');
            $deal->vehicle_color        = Input::get('vehicle_color');
            $deal->vehicle_mileage      = Input::get('vehicle_mileage');
            $deal->active               = Input::get('active');
            $deal->disposition_id       = Input::get('disposition_id');
            $deal->last_visit           = Input::get('last_visit');

            $deal->save();
            // redirect
            Session::flash('message', 'Successfully updated Deal!');
            return Redirect::to('deals');
        }
    }

	public function destroy($id)
	{
		Deal::destroy($id);

		return Redirect::route('deals.index');
	}

    public function campaign()
    {
        $rules = array(
            'deal_id'           => 'required|numeric',
            'campaign_id'       => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        $id = Input::get('deal_id');
        if ($validator->fails()) {
            return Redirect::to('deals/' . $id )
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $deal = Deal::find($id);
            $deal->campaign_id = Input::get('campaign_id');
            $deal->save();

            // redirect
            Session::flash('message', 'Successfully updated Campaign!');
            return Redirect::to('deals/'. $id);
        }
    }

    public function dnc()
    {
        $rules = array(
            'deal_id'           => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        $id = Input::get('deal_id');
        echo $id;
        if ($validator->fails()) {
            return Redirect::to('deals/' . $id )
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $deal = Deal::find($id);
            $agent_id = $deal->agent_id;
            $dealer_id = $deal->dealer_id;

            if (Input::get('dnc_phone')) {
                if (Input::get('yes')) {
                    $deal->dnc_phone = 1;
                } else {
                    $deal->dnc_phone = 0;
                }
            }

            if (Input::get('dnc_phone_work')) {
                if (Input::get('yes')) {
                    $deal->dnc_phone_work = 1;
                } else {
                    $deal->dnc_phone_work = 0;
                }
            }

            if (Input::get('dnc_phone_home')) {
                if (Input::get('yes')) {
                    $deal->dnc_phone_home = 1;
                } else {
                    $deal->dnc_phone_home = 0;
                }
            }

            $deal->save();

            // redirect
            Session::flash('message', 'Successfully updated Campaign!');

            return Redirect::to('agents/'. $agent_id .
                                '/dealer/'. $dealer_id .
                                '/deal/' . $id )
            ;

        }
    }

    public function disposition()
    {
        $rules = array(
            'deal_id'           => 'required|numeric',
            'dealer_id'         => 'required|numeric',
            'disposition_id'    => 'required|numeric',
        );

        if (Input::get('disposition_id')) {
            $disposition = Disposition::find(Input::get('disposition_id'));

            if (preg_match("/^Appointment - Set/",$disposition->name))
            {
                $appointment_rules = array(
                    'appointment'  => 'required'
                );

                $rules = array_merge((array)$rules, (array)$appointment_rules);
            }
        }

        if (Input::get('appointment')) {
            if (Input::get('disposition_id')) {
                $disposition = Disposition::find(Input::get('disposition_id'));

            
                if (!preg_match("/^Appointment - Set/",$disposition->name))
                {
                    $appt_rules = array(
                        'Appointment_Disposition'  => 'required|numeric'
                    );

                    $rules = array_merge((array)$rules, (array)$appt_rules);
                }

            } else {

                    $appt_rules = array(
                        'disposition_id'  => 'required|numeric'
                    );

                    $rules = array_merge((array)$rules, (array)$appt_rules);
            
            }
        }

        # if contact date is selected a contact type is required.
        if (Input::get('next_contact_date')) {
            if (!Input::get('next_contact_type_id')) {
                $appt_rules = array(
                        'next_contact_type_id'  => 'required|numeric'
                    );
                    $rules = array_merge((array)$rules, (array)$appt_rules);
            }
        }

        if (Input::get('next_contact_type_id')) {
            if (!Input::get('next_contact_date')) {
                $appt_rules = array(
                        'next_contact_date'  => 'required'
                    );
                    $rules = array_merge((array)$rules, (array)$appt_rules);
            }
        }

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        $id                 = Input::get('deal_id');
        $dealer_id          = Input::get('dealer_id');
        $agent_id           = Auth::user()->id;
        $last_call          = Input::get('last_call');
        $note               = Input::get('note');
        $confirmation_email = Input::get('confirmation_email');
        $next_contact_date  = Input::get('next_contact_date');
        $next_contact_type_id = Input::get('next_contact_type_id');
        
        if (Input::get('confirmation_email')) {
            if ($note) {
                $note   = $note .' - '. Input::get('confirmation_email');
            } else {
                $note   = Input::get('confirmation_email');
            }
        }

        if ($validator->fails()) {
            return Redirect::to('agents/'. $agent_id . 
                                '/dealer/'. $dealer_id .
                                '/deal/' . $id )
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $deal = Deal::find($id);
            $deal->disposition_id       = Input::get('disposition_id');
            $deal->confirmation_email   = Input::get('confirmation_email');
            $deal->last_called          = date( 'Y-m-d H:i:s' );
            $deal->last_note            = $note;
            if ($next_contact_date && $next_contact_type_id) {
                $deal->next_contact_date    
                    = Input::get('next_contact_date');
                $deal->next_contact_type_id 
                    = Input::get('next_contact_type_id');
            } else {
                $deal->next_contact_date    = null;
                $deal->next_contact_type_id = null;
            } 
            $deal->save();

            // call record
            $call_records = new CallRecord;
            $call_records->agent_id         = Auth::user()->id;
            $call_records->deal_id          = $id;
            $call_records->dealer_id        = Input::get('dealer_id');
            $call_records->disposition_id   = Input::get('disposition_id');
            $call_records->note             = $note;
            $call_records->save();


            if (preg_match("/^Appointment/",$disposition->name) 
                && Input::get('appointment')) {
                // TODO:This might be removed
                $appointment_date =  date( 'Y-m-d H:i:s',
                                strtotime(Input::get('appointment')));

                $deal = Deal::find($id);
                $deal->appointment = $appointment_date;
                $deal->save();

                $appointment = new Appointment;
                $appointment->deal_id       = Input::get('deal_id');
                $appointment->appointment   = $appointment_date;
                $appointment->added_by_id   = Auth::user()->id;
                $appointment->save();

                $customer = array('name'    => $deal->name, 
                    'vehicle_year'          => $deal->vehicle_year,
                    'vehicle_model'         => $deal->vehicle_model,
                    'vehicle_make'          => $deal->vehicle_make,
                    'vehicle_vin'           => $deal->vehicle_vin,
                    'vehicle_mileage'       => $deal->vehicle_mileage,
                    'last_visit'            => $deal->last_visit,
                    'confirmation_email'    => $confirmation_email,
                    'contacted'             => date( 'm-d-Y g:i A' ),
                    'appointment'           => date( 'm-d-Y g:i A',                                                            strtotime($appointment_date)),
                    'note'                  => $note,
                );

                $emails = Dealer::select('appt_recipients')
                    ->where('id',$dealer_id)
                    ->first()
                ;
                $split_recipients = explode(',', $emails->appt_recipients);
                
                $recipients = array();
                foreach ($split_recipients as $value) {
                    $recipients[$value] = "";
                }
                Mail::send('emails.appointment', $customer, function($message) 
                    use($recipients){
                $message->sender('noreply@loyaldriver.com')
                        ->to($recipients)
                        //->to('test@loyaldriver.com','test email')
                        //->bcc('lester@loyaldriver.com','Test Email')
                        ->subject('Loyal Driver - Appointment Alert');
                });

                if($confirmation_email ) {
                    $email_to       = $confirmation_email;
                    $email_name     = $deal->name;
                    $email_dealer   = $deal->dealer->name; 

                    Mail::send('emails.appointment_customer', 
                    $customer, function($message) 
                        use($email_to, $email_name, $email_dealer) {

                    $message->sender('noreply@loyaldriver.com')
                        ->to($email_to ,$email_name)
                        ->bcc('lester@loyaldriver.com','Test Email')
                        ->subject($email_dealer . 
                            ' - Customer Appointment Alert');
                    });
                }

            }

            $non_contacts_disp = array(1,2,3,4,5,6,7,8,9,10);
            if (!in_array(Input::get('disposition_id'), $non_contacts_disp)) {
                $deal = Deal::find($id);
                $deal->agent_id = null;
                $deal->month_id = null;
                $deal->save();
            }
            if ($last_call) {
                $deal = Deal::find($id);
                $deal->agent_id = null;
                $deal->month_id = null;
                $deal->save();
            }

            Session::flash('message', 'Successfully updated Disposition!');
            
            if (Input::get('SaveAndStay')) {
                return Redirect::to('/agents/'.Auth::user()->id .
                                    '/dealer/'. $deal->dealer_id .
                                    '/deal/'. $id
                );
            }
            
            if (Input::get('SaveAndClose')) {
                return Redirect::to('/agents/'.Auth::user()->id .
                                    '/dealer/'. $deal->dealer_id
                );
            }

        }
    }

    public function grid()
    {

        $emails = Dealer::select('appt_recipients')->where('id','1')->first();
        $recipients = explode(',', $emails->appt_recipients);

        foreach ($recipients as $value) {
            $array[$value] = "";
        }

        return View::make('deals.grid')
        ;
    }

    public function gridajax()
    {
        $result = DB::table('deals')
            ->select('deals.id', 'deals.deal_number', 'deals.name',
                     'deals.created_at', 'deals.updated_at')
            ->join('dealers', 'deals.dealer_id', '=', 'dealers.id')
            ->take(5);
        ;

        return Datatables::of($result)  
            ->add_column('edit', '<a href="/admin/article_edit/{{ $id }}"><i class="icon-list-alt"></i>Edit</a>')
            ->add_column('delete', '<a href="/admin/article_delete/{{ $id }}"><i class="icon-trash"></i>Delete</a>')    
            ->make();   
    }


}
