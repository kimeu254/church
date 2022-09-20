<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Expenses;
use \Response;
use DB;
use Yajra\Datatables\Datatables;

class ExpensesController extends Controller
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
        $expense_types = DB::table('tbl_expense_types')->where('church_id',$churchid)->get();

        return view('expenses',[
        'expensetypes' => $expense_types,


        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $expenses = Expenses::create($request->all());
        return Response::json($expenses);
    }
    public function allExpenses()
    {
        $churchid = Auth::user()->church_id;
        //$expenses = DB::table('tbl_expenses')
          //  ->get();
        $expenses = Expenses::with('expense_type')
            ->where('church_id',$churchid)
            ->get();

        return Datatables::of($expenses)
            ->addColumn('action', function ($expenses) {
                return '<a href="#edit-'.$expenses->id.'" class="btn btn-sm btn-primary" onclick="edit_expense(' . "'" . $expenses->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->addColumn('expense_type_detail', function ($row) {
                return $row->expense_type->expense_type ?? 'No expense type';
            })
            ->make(true);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Data\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */

    public function show(Expenses $expenses,$id)
    {
        $data = Expenses::Where('id', $id)
            ->get();

        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Data\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $edit = Expenses::where('id', $id)
            ->update([
                'expense_type_id' =>  $request->expense_type_id,
                'expense_detail' =>  $request->expense_detail,
                'date_received' => $request->date_received,
                'amount' => $request->amount,
                'confirmed' =>  $request->confirmed,
                'status' =>  $request->status,
                'church_id' =>  $request->church_id,

            ]);
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        //
    }

}
