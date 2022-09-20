<?php

namespace App\Http\Controllers;

use App\Data\Members;
use App\Imports\MembersImport;
use Illuminate\Http\Request;
use App\Data\Groups;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use \Response;
use DB;
use Yajra\Datatables\Datatables;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $churchid = Auth::user()->church_id;
        $groups = Groups::where('church_id', $churchid)->get();
        $residentialareas = DB::table('tbl_residential_zones')->where('church_id', $churchid)->get();
        $name = DB::table('tbl_groups')->where('church_id', $churchid)->get();


        return view('members', compact('groups', 'residentialareas', 'name'));
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

    public function import()
    {
        Excel::import(new MembersImport, request()->file('members'));

        return response()->json([
            'message' => 'Members imported successfully!',
            'status' => \Illuminate\Http\Response::HTTP_OK
        ]);

    }

    public function template()
    {
        return response()->download(storage_path('/app/public/PalmChurch Member Import Template.xlsx'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $churchid = Auth::user()->church_id;
        $count = Members::where('church_id', $churchid)->count();
        $abbreviation = 'M';
        $memberNumber = $abbreviation . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $request['membership_number'] = $memberNumber;
        $members = Members::create($request->all());
        return Response::json($members);
    }

    public function allMembers(Request $request)
    {
        $churchid = Auth::user()->church_id;
        $members = DB::table('tbl_members')
            ->leftJoin('tbl_residential_zones', 'tbl_residential_zones.id', '=', 'tbl_members.residence_zone')
            //->with('groups')
            ->select('tbl_members.*', 'tbl_residential_zones.zone_name')
            ->when(isset($request->filter_gender), function ($q) use ($request) {
                $q->where('gender', $request->filter_gender);
            })
            ->when(isset($request->filter_residence_zone), function ($q) use ($request) {
                $q->where('residence_zone', $request->filter_residence_zone);
            })
            ->when(isset($request->filter_marital_status), function ($q) use ($request) {
                $q->where('marital_status', $request->filter_marital_status);
            })
            ->when(isset($request->filter_married_in_church), function ($q) use ($request) {
                $q->where('married_in_church', $request->filter_married_in_church);
            })
            ->when(isset($request->filter_baptized_members), function ($q) use ($request) {
                $q->where('baptized', $request->filter_baptized_members);
            })
            ->where('tbl_members.church_id', $churchid)
            ->get();

        return Datatables::of($members)
            ->addColumn('action', function ($member) {
                return '<a href="#edit-' . $member->id . '" class="btn btn-sm btn-primary" onclick="edit_member(' . "'" . $member->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i> Edit</a>
                    <a href="#groups" title="Groups" class="btn btn-success btn-sm" onclick="groups(' . "'" . $member->id . "'" . ')"> Groups</a>';
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Data\Members $members
     * @return \Illuminate\Http\Response
     */
    public function show(Members $members, $id)
    {
        $data = Members::Where('id', $id)
            ->get();

        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Data\Members $members
     * @return \Illuminate\Http\Response
     */
    public function edit(Members $members)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Data\Members $members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Members::where('id', $id)
            ->update([
                'name' => $request->name,
                'national_id' => $request->national_id,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'residence_zone' => $request->residence_zone,
                'confirmed' => $request->confirmed,
                'baptized' => $request->baptized,
                'marital_status' => $request->marital_status,
                'status' => $request->status,
                'married_in_church' => $request->married_in_church,
            ]);
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Data\Members $members
     * @return \Illuminate\Http\Response
     */
    public function destroy(Members $members)
    {
        //
    }

    public function memberGroups($member_id = NULL)
    {
        $churchid = Auth::user()->church_id;
        $groups = DB::select("SELECT tbl_groups.id,tbl_groups.church_id,tbl_groups.name,tbl_group_members.status FROM tbl_groups
           LEFT JOIN tbl_group_members ON tbl_group_members.group_id = tbl_groups.id AND tbl_group_members.member_id = '$member_id' 
           WHERE tbl_groups.church_id = '$churchid'");

        return Datatables::of($groups)
            ->addColumn('groupname', function ($group) {
                return '<div class="checkbox checkbox-custom" style="padding-left:5px;">
                                            <input type="checkbox" name="present[]" value=" ' . $group->id . '" ' . $group->status . '>
                                            <label for="" style="padding-left:5px;">
                                                ' . $group->name . '
                                            </label>
                                        </div>';


            })->rawColumns(['groupname'])
            ->make(true);
    }

    public function saveGroups($moduleData, $user_id)
    {
        $churchid = Auth::user()->church_id;
        $checkroute = DB::table('tbl_group_members')
            ->where([
                ['member_id', '=', $user_id],
                ['church_id', '=', $churchid],
            ])
            ->update([
                'status' => '',
            ]);

        $variableAry = explode(",", $moduleData);
        foreach ($variableAry as $id) {
            $record = DB::table('tbl_group_members')
                ->where([
                    ['member_id', '=', $user_id],
                    ['church_id', '=', $churchid],
                    ['group_id', '=', $id],
                ])->count();

            if ($record == 0) {
                DB::table('tbl_group_members')->insert([
                    ['member_id' => $user_id, 'group_id' => $id,'church_id'=> $churchid, 'status' => 'checked']
                ]);
            } else {
                $record = DB::table('tbl_group_members')
                    ->where([
                        ['member_id', '=', $user_id],
                        ['church_id', '=', $churchid],
                        ['group_id', '=', $id],
                        //['resource_type', '=', $resource]
                    ])
                    ->update([
                        'status' => 'checked',
                    ]);
            }

        }

        return response()->json($record);
    }
}
