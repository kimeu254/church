<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\ExpenseTypes;
use \Response;
use DB;
use Yajra\Datatables\Datatables;

class ExpenseTypesController extends Controller
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

        return view('settings.expensetypes');
    }

    public function store(Request $request){

        // ExpenseTypes::create($r);
        $expensetypes = ExpenseTypes::create($request->all());

        return Response::json($expensetypes);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {


        $churchid = Auth::user()->church_id;
        $expensetypes = ExpenseTypes::where('church_id',$churchid)->get();
        /*$expensetypes = DB::table('expensetypes')
            ->get();*/
        return Datatables::of($expensetypes)
            ->addColumn('action', function ($expensetypes) {
                return '<a href="#edit-'.$expensetypes->id.'" class="btn btn-sm btn-primary" onclick="edit_expense_type(' . "'" . $expensetypes->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = ExpenseTypes::Where('id', $id)
            ->get();

        return json_encode($data);
        // return $expensetypes;
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
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $edit = ExpenseTypes::where('id', $id)
            ->update([
                'expense_type' =>  $request->expense_type,
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
        $data = ExpenseTypes::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
        phpinfo();
    }
}
