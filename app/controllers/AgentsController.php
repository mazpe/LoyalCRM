<?php

use Carbon\Carbon;

class AgentsController extends \BaseController {

	/**
	 * Display a listing of agents
	 *
	 * @return Response
	 */
	public function index()
	{
		$agents = User::all();

		return View::make('agents.index', compact('agents'));
	}

	/**
	 * Show the form for creating a new agent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('agents.create');
	}

	/**
	 * Store a newly created agent in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Agent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Agent::create($data);

		return Redirect::route('agents.index');
	}

	public function show($id)
	{
		$agent = User::findOrFail($id);
        $deals = Deal::where('agent_id','=',$id)->get();

		return View::make('agents.show')
            ->with(compact('agent'))
            ->with(compact('deals'))
        ;
	}

    public function profile($id)
    {
        $agent = User::findOrFail($id);
        $dealers = Dealer::select('dealers.name as dealer', 'dealers.city',
                'dealers.id as dealer_id', 'dealer_groups.name as dealergroup',
                'manufactures.name as manufacture','stages.name as stage',
                'next_contact_date', 'users.name as strategist',
                'contact_types.name as next_contact_type'
            )
            ->where('agent_id',$id)
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
        ;


        $stages = array('' => 'Select a Stage') +
            Stage::lists('name', 'id');
        $stages_counter = Stage::select('stages.id as id','stages.name as name',
                'stages.description as description',
                DB::raw('count(*) as count'))
            ->leftjoin('dealers','stages.id','=','dealers.stage_id')
            ->where('agent_id',$id)
            ->groupBy('stages.id')
            ->orderBy('stages.sorting')
            ->get()
        ;

        $dealers_count = $dealers->count();
        $dealers = $dealers->get();
        $dealer_groups = array('' => 'Select a Dealer Group') +
            DealerGroup::lists('name', 'id');
        $manufactures = array('' => 'Select a Manufacture') +
            Manufacture::lists('name', 'id');

        return View::make('agents.profile')
            ->with(compact('agent'))
            ->with(compact('dealers'))
            ->with(compact('dealer_groups'))
            ->with(compact('manufactures'))
            ->with('stages', $stages)
            ->with('stages_counter', $stages_counter)
            ->with('dealers_count', $dealers_count)

        ;
    }

    public function leads($id)
    {
        $agent = User::findOrFail($id);
        $dealers = Dealer::select('dealers.name as dealer','dealers.city',
                'dealers.id as dealer_id', 'dealer_groups.name as dealergroup',
                'manufactures.name as manufacture','stages.name as stage',
                'last_contact_date','next_contact_date', 
                'users.name as strategist','users.initials',
                'contact_types.name as next_contact_type'
            )
        ;

            if(Auth::user()->hasRole('Admin')) {
                } else {
            $dealers->where('agent_id',$id);
        }

        $dealers->with('dealergroup')
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
            ->take(100)
        ;
        $stages = array('' => 'Select a Stage') +
            Stage::lists('name', 'id');
        $stages_counter = Stage::select('stages.id as id','stages.name as name',
                'stages.description as description',
                DB::raw('count(*) as count'))
            ->leftjoin('dealers','stages.id','=','dealers.stage_id')
            ->where('agent_id',$id)
            ->groupBy('stages.id')
            ->orderBy('stages.sorting')
            ->get()
        ;

        $dealers_count = $dealers->count();
        $dealers = $dealers->get();
        $dealer_groups = array('' => 'Select a Dealer Group') +
            DealerGroup::lists('name', 'id');
        $manufactures = array('' => 'Select a Manufacture') +
            Manufacture::lists('name', 'id');
        $agents = array('' => 'Select an Agent') +
            User::lists('name', 'id');
        $cities = array('' => 'Select a City') +
            DB::table('dealers')->distinct('city')->orderBy('city')
            ->lists('city', 'city')
        ;

        return View::make('agents.leads')
            //->with(compact('stages'))
            ->with(compact('agents'))
            ->with(compact('agent'))
            ->with(compact('dealers'))
            ->with(compact('dealer_groups'))
            ->with(compact('cities'))
            ->with(compact('manufactures'))
            ->with('stages', $stages)
            ->with('stages_counter', $stages_counter)
            ->with('dealers_count', $dealers_count)

        ;
    }


    public function percent($number)
    {
        return number_format($number * 100,2,'.',',')."%";
    }

	public function edit($id)
	{
		$agent = Agent::find($id);

		return View::make('agents.edit', compact('agent'));
	}

	public function update($id)
	{
		$agent = Agent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Agent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$agent->update($data);

		return Redirect::route('agents.index');
	}

	public function destroy($id)
	{
		Agent::destroy($id);

		return Redirect::route('agents.index');
	}

    public function dealer($agent_id,$dealer_id) 
    {
        $dealer = Dealer::find($dealer_id);
        $year = date('Y');
        $month = date('m');

        $dt2 = Carbon::create($year,$month);
        $dt3 = Carbon::create($year,$month);
        $startofmonth           = $dt2->startOfMonth();
        $endofmonth             = $dt3->endOfMonth();

        $deals_sql = DB::table('deals')
            ->select('deals.id','deals.name','deals.last_called',
                'deals.disposition_id','call_records.note',
                'dispositions.name as disposition_name', 
                'deals.next_contact_date'
            )
            ->leftjoin('call_records', function($join)
            {
                $join->on('deals.id','=','call_records.deal_id')
                ->on('deals.disposition_id','=','call_records.disposition_id');
            })
            ->leftjoin('dispositions','deals.disposition_id','=',
                'dispositions.id')
            ->where('deals.dealer_id','=',$dealer_id)
            ->where('deals.agent_id','=',$agent_id)
            ->where('deals.month_id',date('m'))
            ->orderBy('last_called','ASC')
            ->orderBy('assigned_month_id','ASC')
        ;

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
            ->where('deals.dealer_id','=',$dealer_id)
            ->where('deals.agent_id','=',$agent_id)
            ->where('deals.month_id',date('m'))
            ->orderBy('last_called','ASC')
            ->orderBy('assigned_month_id','ASC')
        ;
        $deals_count = $deals_sql->count();
        $deals = $deals_sql->get();

        $calls = CallRecord::where('dealer_id','=',$dealer_id)
                 ->where('created_at','>=',$startofmonth)
                 ->where('created_at','<=',$endofmonth)
        ;
        $callstotal = $calls->count();

        $appointments_count = CallRecord::where('dealer_id',$dealer_id)
            ->where('disposition_id','>=','11')
            ->where('disposition_id','<=','13')
            ->where('created_at','>=',$startofmonth)
            ->where('created_at','<=',$endofmonth)
            ->count()
        ;
        if ($appointments_count > 0 && $callstotal > 0 ) {
            $appointments_count_perc 
                = ($appointments_count / $callstotal) * 100;
        } else {
            $appointments_count_perc = 0;
        }

        $appointments_total_count = CallRecord::where('dealer_id',$dealer_id)
            ->where('disposition_id','>=','11')
            ->where('disposition_id','<=','16')
            ->where('created_at','>=',$startofmonth)
            ->where('created_at','<=',$endofmonth)
            ->count()
        ;

        if ($appointments_total_count > 0 && $callstotal > 0) {
            $appointments_total_count_perc 
                = ($appointments_total_count / $callstotal) * 100;
        } else {
            $appointments_total_count_perc = 0;
        }

        $today_mysql = date('Y').date('m').date('d');

        $reminders_sql = Deal::where('dealer_id',$dealer_id)
            ->where('next_contact_date','LIKE',$today_mysql."%");
        $reminders_count = $reminders_sql->count();

        $dispositions = array('' => 'Select a Disposition') +
            Disposition::lists('name', 'id');

        return View::make('agents.deals')
            ->with(compact('dispositions'))
            ->with(compact('dealer'))
            ->with(compact('deals_count'))
            ->with(compact('deals'))
            ->with('agent_id',$agent_id)
            ->with('callstotal',$callstotal)
            ->with('appointments_count',$appointments_count)
            ->with('appointments_count_perc',$appointments_count_perc)
            ->with('appointments_total_count',$appointments_total_count)
            ->with('appointments_total_count_perc',
                $appointments_total_count_perc)
        ;
    }

    public function lead_search($id)
    {

        $limit                      = Input::get('limit');
        $agent_id                   = Input::get('agent_id');
        $dealer_group_id            = Input::get('dealer_group_id');
        $dealer                     = Input::get('dealer');
        $manufacture_id             = Input::get('manufacture_id');
        $city                       = Input::get('city');
        $stage_id                   = Input::get('stage_id');
        $limit                      = Input::get('limit');
        $last_contact_from          = Input::get('last_contact_from');
        $last_contact_to            = Input::get('last_contact_to');
        $next_contact_from          = Input::get('next_contact_from');
        $next_contact_to            = Input::get('next_contact_to');
        $sort_1                     = Input::get('sort_1');
        $sort_1_dir                 = Input::get('sort_1_dir');
        $sort_2                     = Input::get('sort_2');
        $sort_2_dir                 = Input::get('sort_2_dir');
        $sort_3                     = Input::get('sort_3');
        $sort_3_dir                 = Input::get('sort_3_dir');
        $sort_4                     = Input::get('sort_4');
        $sort_4_dir                 = Input::get('sort_4_dir');
        
        $agent = User::findOrFail($id);
        $dealers = Dealer::select('dealers.name as dealer','dealers.city',
                'dealers.id as dealer_id', 'dealer_groups.name as dealergroup',
                'manufactures.name as manufacture','stages.name as stage',
                'last_contact_date','next_contact_date', 
                'users.name as strategist','users.initials as initials',
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
                'dealers.next_contact_type_id','=','contact_types.id');
            if ($agent_id) {
                if($agent_id == "All" && Auth::user()->hasRole('Admin')) {
                } else {
                    $dealers->where('agent_id',$agent_id);
                }
            }
            if ($dealer_group_id) {
                $dealers->where('dealer_group_id',$dealer_group_id);
            }
            if ($dealer) { $dealers->where('dealers.name','LIKE',$dealer); }
            if ($manufacture_id) {
                $dealers->where('manufacture_id',$manufacture_id);
            }
            if ($city) {
                $dealers->where('dealers.city',$city);
            }
            if ($stage_id) { $dealers->where('stage_id',$stage_id); }
            if ($limit != "All") { 
                $dealers->take($limit); 
            }

            if ($last_contact_from && $last_contact_to) {
                $from = date( 'Y-m-d', strtotime($last_contact_from));
                $to = date( 'Y-m-d', strtotime($last_contact_to)). '23:59:59';
                $dealers->where('last_contact_date', '>=',$from);
                $dealers->where('last_contact_date', '<=',$to);
            }
            if ($next_contact_from && $next_contact_to) {
                $from = date( 'Y-m-d', strtotime($next_contact_from));
                $to = date( 'Y-m-d', strtotime($next_contact_to)). '23:59:59';
                $dealers->where('next_contact_date', '>=',$from);
                $dealers->where('next_contact_date', '<=',$to); 
            }

            if ($sort_1) { 
                if ($sort_1 == "next_contact_date") {
                    $dealers->orderByRaw(
                        'dealers.next_contact_date IS NOT NULL DESC, 
                            dealers.next_contact_date
                    ');
                } else {
                    $dealers->orderBy($sort_1,$sort_1_dir); 
                }
            }
            if ($sort_2) {
                if ($sort_2 == "next_contact_date") {
                    $dealers->orderByRaw(
                        'dealers.next_contact_date IS NOT NULL DESC,
                            dealers.next_contact_date
                    ');
                } else {
                    $dealers->orderBy($sort_2,$sort_2_dir);
                }
            }
            if ($sort_3) {
                if ($sort_3 == "next_contact_date") {
                    $dealers->orderByRaw(
                        'dealers.next_contact_date IS NOT NULL DESC,
                            dealers.next_contact_date
                    ');
                } else {
                    $dealers->orderBy($sort_3,$sort_3_dir);
                }
            }
            if ($sort_4) {
                if ($sort_4 == "next_contact_date") {
                    $dealers->orderByRaw(
                        'dealers.next_contact_date IS NOT NULL DESC,
                            dealers.next_contact_date
                    ');
                } else {
                    $dealers->orderBy($sort_4,$sort_4_dir);
               }
            }

        $stages = array('' => 'Select a Stage') +
            Stage::lists('name', 'id');
        $stages1 = array('' => 'Select a Stage') +
            Stage::lists('name', 'id');


        $stages_counter = Stage::select('stages.id as id','stages.name as name',
                'stages.description as description',
                DB::raw('count(*) as count'))
            ->leftjoin('dealers','stages.id','=','dealers.stage_id')
        ;

        if ($agent_id) {
            if($agent_id == "All" && Auth::user()->hasRole('Admin')) {
            } else {
                $stages_counter->where('agent_id',$agent_id);
            }
        }
        
        $stages_counter
            ->groupBy('stages.id')
            ->orderBy('stages.sorting')
            ->get()
        ;

        $dealers_count = $dealers->count();
        $dealers = $dealers->get();
        $dealer_groups = array('' => 'Select a Dealer Group') +
            DealerGroup::lists('name', 'id');
        $manufactures = array('' => 'Select a Manufacture') +
            Manufacture::lists('name', 'id');
        $agents = array('' => 'Select an Agent') +
            User::lists('name', 'id');
        $cities = array('' => 'Select a City') +
            DB::table('dealers')->distinct('city')->orderBy('city')->lists('city', 'city');


        return View::make('agents.leads')
            ->with(compact('agent'))
            ->with(compact('dealers'))
            ->with(compact('dealer_groups'))
            ->with(compact('manufactures'))
            ->with(compact('cities'))
            ->with(compact('agents'))
            ->with(compact('stages_counter'))
            ->with(compact('stages1'))
            ->with('stages', $stages)
            ->with('dealers_count', $dealers_count)
        ;


    }


    public function deal($agent_id,$dealer_id,$id)
    {
        $deal = Deal::findOrFail($id);
        $dispositions = array('' => 'Select a Disposition') +
            Disposition::where('name','!=','No Calls Yet')
            ->where('name','!=','Do Not Call - C')
            ->where('name','!=','Do Not Call - H')
            ->where('name','!=','Do Not Call - W')
            ->where('name','!=','Do Not Call - ALL')
            ->where('name','!=','Not Interested')
            ->where('name','!=','Not Ready Yet')
            ->lists('name', 'id');
        $dispositions_rp = Disposition::all();
        $contact_types = array('' => 'Select a Call Type') +
            ContactType::lists('name', 'id');
        $notes = CallRecord::where('deal_id','=',$id)
            ->orderBy('created_at','DESC')
            ->get();

        $dt = Carbon::now();
        $purchase_date = Carbon::createFromTimeStamp(
            strtotime($deal->purchase_date)
        );
        $service_date = Carbon::createFromTimeStamp(
            strtotime($deal->last_visit)
        );
        $disposition = CallRecord::where('deal_id','=',$id)
            ->orderBy('created_at','DESC')
            ->first();

        return View::make('agents.deal')
            ->with(compact('deal'))
            ->with(compact('contact_types'))
            ->with(compact('disposition'))
            ->with(compact('dispositions'))
            ->with(compact('dispositions_rp'))
            ->with(compact('notes'))
            ->with(compact('purchase_date'))
            ->with(compact('service_date'))
        ;
    }

}
