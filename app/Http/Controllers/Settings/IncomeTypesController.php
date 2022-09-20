<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\IncomeTypes;
use \Response;
use DB;
use Yajra\Datatables\Datatables;


class IncomeTypesController extends Controller
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

        return view('settings.incometypes');
    }

    public function store(Request $request){

        // IncomeTypes::create($r);
        $incometypes = IncomeTypes::create($request->all());

        return Response::json($incometypes);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $churchid = Auth::user()->church_id;
//        $incometypes = DB::table('incometypes')
//            ->get();
        $incometypes = IncomeTypes::where('church_id',$churchid)->get();
        return Datatables::of($incometypes)
            ->addColumn('action', function ($incometypes) {
                return '<a href="#edit-'.$incometypes->id.'" class="btn btn-sm btn-primary" onclick="edit_income_type(' . "'" . $incometypes->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = IncomeTypes::Where('id', $id)
            ->get();

        return json_encode($data);
        // return $incometypes;
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $edit = IncomeTypes::where('id', $id)
            ->update([
                'income_type' =>  $request->income_type,
                'status' =>  $request->status,
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
        $data = IncomeTypes::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
        phpinfo();
    }
}
