<?php

namespace App\Http\Controllers;

use App\Data\Groups;
use App\Data\Members;
use App\Data\Zones;
use App\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $messagesRepo;
    protected $membershipRepo;

    public function __construct()
    {
        $this->messagesRepo = new MessagingController();
        $this->membershipRepo = new CommonController();
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $membershipNUmber = Auth::user()->membership_number;
        if (is_null($membershipNUmber)) {
/*            $number = (new CommonController())->generateMembershipNumber();*/
            $number = ($this->membershipRepo->generateMembershipNumber());
            $user->membership_number = $number;
            $user->update();
        }

        $churchid = Auth::user()->church_id;
        $totalmembers = DB::table('tbl_members')->where('church_id', $churchid)->count();
        $registeredmembers = DB::table('tbl_members')->whereNotnull('membership_number')->where('church_id', $churchid)->count();
        $totalmale = DB::table('tbl_members')->where('gender', 'Male')->where('church_id', $churchid)->count();
        $totalfemale = DB::table('tbl_members')->where('gender', 'Female')->where('church_id', $churchid)->count();
        $totalincomes = DB::table('tbl_incomes')->where('church_id', $churchid)->sum('amount');
        $totalexpenses = DB::table('tbl_expenses')->where('church_id', $churchid)->sum('amount');

        $formatIncomes = number_format("$totalincomes");
        $formatRegistered = number_format("$registeredmembers");
        $formatExpenses = number_format("$totalexpenses");
        $formatMembers = number_format("$registeredmembers");
        $formatFemale = number_format("$totalfemale");
        $formatMale = number_format("$totalmale");

        $zone = Zones::join('tbl_members', 'tbl_members.residence_zone', '=', 'tbl_residential_zones.id')
            ->where('tbl_residential_zones.church_id', $churchid)
            ->selectRaw('count(tbl_members.id) as total, tbl_residential_zones.zone_name')
            ->groupBy('zone_name')
            ->get();

        $group = Groups::join('tbl_group_members', 'tbl_group_members.group_id', '=', 'tbl_groups.id')
            ->where('tbl_groups.church_id', $churchid)
            ->selectRaw('count(tbl_group_members.group_id) as total, tbl_groups.name')
            ->groupBy('name')
            ->get();

        $totalbyarea = 0; //DB::table('tbl_members')->leftJoin('tbl_residential_zones', 'tbl_residential_zones.id', '=', 'tbl_members.residence_zone')
        //->select('COUNT(tbl_members.id) AS count')->groupBy('residence_zone')->get();

        // get the total number of messages ...

        $totalMessages = $this->messagesRepo->outboxCount();

        $pending = $this->messagesRepo->pendingCount();

        $sms_data = ($this->messagesRepo->messagesByDay());

        $availableUnits = $this->messagesRepo->available();

        $formatMessages = number_format("$totalMessages");

        $zone_data = Zones::join('tbl_members', 'tbl_members.residence_zone', '=', 'tbl_residential_zones.id')
            ->where('tbl_residential_zones.church_id', $churchid)
            ->selectRaw('count(tbl_members.id) as total, tbl_residential_zones.zone_name')
            ->groupBy('zone_name')
            ->get();

        $zone_chart_data = [];
        $index = -1;
        foreach ($zone_data as $item) {
            $index += 1;
            $zone_chart_data['labels'][$index] = $item->zone_name;
            $zone_chart_data['data'][$index] = $item->total;
        }

        $group_data = Groups::join('tbl_group_members', 'tbl_group_members.group_id', '=', 'tbl_groups.id')
            ->where('tbl_groups.church_id', $churchid)
            ->selectRaw('count(tbl_group_members.group_id) as total, tbl_groups.name')
            ->groupBy('name')
            ->get();
        $group_chart_data = [];
        $index = -1;
        foreach ($group_data as $item) {
            $index += 1;
            $group_chart_data['labels'][$index] = $item->name;
            $group_chart_data['data'][$index] = $item->total;
        }


        return view('dashboard', compact('zone_chart_data', 'availableUnits', 'sms_data', 'group_chart_data', 'zone_data','formatMembers','formatMale','formatRegistered','formatFemale', 'group_data', 'formatIncomes','formatExpenses','totalmembers', 'totalmale', 'totalfemale', 'totalbyarea', 'registeredmembers','formatMessages', 'totalMessages', 'pending', 'totalexpenses', 'totalincomes', 'group', 'zone'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
