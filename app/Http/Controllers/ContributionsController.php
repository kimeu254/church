<?php

namespace App\Http\Controllers;

use App\Data\Contributions;
use App\Data\Members;
use App\Data\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Response;
use DB;
use Yajra\DataTables\DataTables;

class ContributionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $churchid = Auth::user()->church_id;
        $project_name = Projects::where('church_id',$churchid)->get();
        $name = Members::where('church_id',$churchid)->get();

        return view('contributions', [
            'projects' => $project_name,
            'members' => $name,
        ]);

    }

    public function store(Request $request)
    {

        //Contributions::create($r);
        $contributions = Contributions::create($request->all());

        return Response::json($contributions);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {

        $churchid = Auth::user()->church_id;
        //$contributions = DB::table('tbl_contributions')
        //    ->get();
       /* $contributions = Contributions::with('project_name', 'name')
            ->get();*/
        $contributions = Contributions::with('project_name', 'name')
            ->where('church_id',$churchid)
            ->get();
        return Datatables::of($contributions)
            ->addColumn('action', function ($contributions) {
                return '<a href="#edit-' . $contributions->id . '" class="btn btn-sm btn-primary" onclick="edit_contribution(' . "'" . $contributions->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->addColumn('project_name_detail', function ($row) {
                return $row->project_name->project_name ?? 'No project name';
            })
           /* ->addColumn('name', function ($row) {
                return $row->name->name ?? '';
            })*/
            ->addColumn('member_name', function ($row) {
                if ($row->name != null) {
                    return $row->name->name;
                } else {
                    return $row->names;
                }
            })
            ->make(true);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = Contributions::Where('id', $id)
            ->get();

        return json_encode($data);
        // return $contribution;
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $edit = Contributions::where('id', $id)
            ->update([
                'member' => $request->member,
                'names' => $request->names,
                'phone_number' => $request->phone_number,
                'project_name_id' => $request->project_name_id,
                'contribution_date' => $request->contribution_date,
                'payment_mode' => $request->payment_mode,
                'amount_contributed' => $request->amount_contributed,
                'code' => $request->code,
                'church_id' =>  $request->church_id,
            ]);
        return response()->json($edit);

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $data = Contributions::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
        phpinfo();
    }
}
