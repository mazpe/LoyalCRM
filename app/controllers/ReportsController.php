<?php

use Carbon\Carbon;

class ReportsController extends \BaseController {

	/**
	 * Display a listing of reports
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = User::find(Auth::user()->id);
		return View::make('reports.index',compact('user'));
	}

    public function agents($agent_id)
    {
        $agent = User::find($agent_id);
        $year = date('Y');
        $month = date('m');

        $dt2 = Carbon::create($year,$month);
        $dt3 = Carbon::create($year,$month);
        $startofmonth           = $dt2->startOfMonth();
        $endofmonth             = $dt3->endOfMonth();

        $deals_sql = DB::table('deals')
            ->select('deals.id','deals.name','deals.last_called',
                'deals.disposition_id','last_note',
                'dispositions.name as disposition_name',
                'deals.next_contact_date',
                'contact_types.name as next_contact_type'
            )
            ->leftjoin('dispositions',
                'deals.disposition_id','=','dispositions.id')
            ->leftjoin('contact_types',
                'deals.next_contact_type_id','=','contact_types.id')
            ->where('deals.agent_id','=',$agent_id)
            ->where('deals.month_id',date('m'))
            ->orderBy('last_called','ASC')
            ->orderBy('assigned_month_id','ASC')
        ;
        $deals_count = $deals_sql->count();
        $deals = $deals_sql->get();

        $calls = CallRecord::where('agent_id',$agent_id)
                ->where('created_at','>=',$startofmonth)
                 ->where('created_at','<=',$endofmonth)
        ;
        $callstotal = $calls->count();

        $calls_cell_sql = DB::table('call_records')
            ->select('id')
            ->join('dispositions',
                'call_records.disposition_id','=','dispositions.id')
            ->where('agent_id',$agent_id)
            ->where('dispositions.name','LIKE','%- C')
            ->where('call_records.created_at','>=',$startofmonth)
            ->where('call_records.created_at','<=',$endofmonth)
        ;
        $calls_cell_count = $calls_cell_sql->count();

        $calls_home_sql = DB::table('call_records')
            ->select('id')
            ->join('dispositions',
                'call_records.disposition_id','=','dispositions.id')
            ->where('agent_id',$agent_id)
            ->where('dispositions.name','LIKE','%- H')
            ->where('call_records.created_at','>=',$startofmonth)
            ->where('call_records.created_at','<=',$endofmonth)
        ;
        $calls_home_count = $calls_home_sql->count();

        $calls_work_sql = DB::table('call_records')
            ->select('id')
            ->join('dispositions',
                'call_records.disposition_id','=','dispositions.id')
            ->where('agent_id',$agent_id)
            ->where('dispositions.name','LIKE','%- W')
            ->where('call_records.created_at','>=',$startofmonth)
            ->where('call_records.created_at','<=',$endofmonth)
        ;
        $calls_work_count = $calls_work_sql->count();

        $appointments_count = CallRecord::where('agent_id',$agent_id)
            ->where('disposition_id','>=','11')
            ->where('disposition_id','<=','13')
            ->where('created_at','>=',$startofmonth)
            ->where('created_at','<=',$endofmonth)
            ->count();
        ;
        if ($appointments_count > 0 && $callstotal > 0 ) {
            $appointments_count_perc
                = ($appointments_count / $callstotal) * 100;
        } else {
            $appointments_count_perc = 0;
        }

        $appointments_total_count = CallRecord::where('agent_id',$agent_id)
            ->where('disposition_id','>=','11')
            ->where('disposition_id','<=','16')
            ->where('created_at','>=',$startofmonth)
            ->where('created_at','<=',$endofmonth)
            ->count();
        ;

        if ($appointments_total_count > 0 && $callstotal > 0) {
            $appointments_total_count_perc
                = ($appointments_total_count / $callstotal) * 100;
        } else {
            $appointments_total_count_perc = 0;
        }

        $today_mysql = date('Y').date('m').date('d');

        $reminders_sql = Deal::where('next_contact_date','LIKE',$today_mysql."%");
        $reminders_count = $reminders_sql->count();

        $dispositions = array('' => 'Select a Disposition') +
            Disposition::lists('name', 'id');

        return View::make('reports.agents')
            ->with(compact('agent'))
            ->with(compact('dispositions'))
            ->with(compact('dealer'))
            ->with(compact('deals_count'))
            ->with(compact('deals'))
            ->with('agent_id',$agent_id)
            ->with('callstotal',$callstotal)
            ->with('calls_cell_count',$calls_cell_count)
            ->with('calls_home_count',$calls_home_count)
            ->with('calls_work_count',$calls_work_count)
            ->with('appointments_count',$appointments_count)
            ->with('appointments_count_perc',$appointments_count_perc)
            ->with('appointments_total_count',$appointments_total_count)
            ->with('appointments_total_count_perc',
                $appointments_total_count_perc)
        ;
        //return View::make('reports.agents');
    }

	/**
	 * Show the form for creating a new seport
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
        return View::make('reports.create')
            ->with('dealer_options',$dealer_options)
            ->with('added_by_options',$added_by_options)
        ;
	}

	/**
	 * Store a newly created seport in storage.
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
            return Redirect::to('reports/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $seport = new Report;
            $seport->name         = Input::get('name');
            $seport->dealer_id    = Input::get('dealer_id');
            $seport->added_by_id  = Input::get('added_by_id');
            $seport->save();

            // redirect
            Session::flash('message', 'Successfully created Report!');
            return Redirect::to('reports');
        }

	}

	/**
	 * Display the specified seport.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$seport = Report::findOrFail($id);

		return View::make('reports.show', compact('seport'));
	}

	/**
	 * Show the form for editing the specified seport.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$seport = Report::find($id);
        $dealer_options = array('' => 'Select a Dealer') +
            Dealer::lists('name', 'id');
        $added_by_options = array('' => 'Select a User') +
            User::lists('name', 'id');

        return View::make('reports.edit')
            ->with('seport', $seport)
            ->with('dealer_options',$dealer_options)
            ->with('added_by_options',$added_by_options)
        ;

	}

	/**
	 * Update the specified seport in storage.
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
            return Redirect::to('reports/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $seport = Report::find($id);
            $seport->name         = Input::get('name');
            $seport->dealer_id    = Input::get('dealer_id');
            $seport->added_by_id  = Input::get('added_by_id');
            $seport->active       = Input::get('active');
            $seport->save();

            // redirect
            Session::flash('message', 'Successfully updated seport!');
            return Redirect::to('reports');
        }

	}

	/**
	 * Remove the specified seport from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Report::destroy($id);

		return Redirect::route('reports.index');
	}

}
