<?php

namespace App\Http\Controllers;

use App\Data\Incomes;
use App\Data\IncomeTypes;
use App\Data\Members;
use App\Data\Schedules;
use App\Data\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Response;
use DB;
use Yajra\Datatables\Datatables;

class IncomesController extends Controller
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
        $income_types = IncomeTypes::where('church_id',$churchid)->get();
        $name = Members::where('church_id',$churchid)->get();
        $service_name = Schedules::where('church_id',$churchid)->get();



        return view('incomes', [
            'income_types' => $income_types,
            'service' => $service_name,
            'members' => $name,

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $incomes = Incomes::create($request->all());
        return Response::json($incomes);
    }

    public function allIncomes()
    {
        $churchid = Auth::user()->church_id;
        $incomes = Incomes::with('income_type')
            ->where('church_id',$churchid)
            ->get();
//        $incomes = Incomes::with('income_type')
//            ->get();
        return Datatables::of($incomes)
            ->addColumn('action', function ($incomes) {
                return '<a href="#edit-' . $incomes->id . '" class="btn btn-sm btn-primary" onclick="edit_income(' . "'" . $incomes->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })  
            ->addColumn('income_type_detail', function ($row) {
                return $row->income_type->income_type ?? 'No income type';
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Data\Incomes $incomes
     * @return \Illuminate\Http\Response
     */

    public function show(Incomes $incomes, $id)
    {
        $data = Incomes::Where('id', $id)
            ->get();

        return json_encode($data);
        // return $incomes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Data\Incomes $incomes
     * @return \Illuminate\Http\Response
     */
    public function edit(Incomes $incomes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Data\Incomes $incomes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Incomes::where('id', $id)
            ->update([
                'income_type_id' => $request->income_type_id,
                'income_detail' => $request->income_detail,
                'member' => $request->member,
                'service' => $request->service,
                'date_received' => $request->date_received,
                'payment_mode' => $request->payment_mode,
                'code' => $request->code,
                'amount' => $request->amount,
                'confirmed' => $request->confirmed,
                'status' => $request->status,
                'church_id' =>  $request->church_id,

            ]);
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Data\Incomes $incomes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incomes $incomes)
    {
        //
    }

}
