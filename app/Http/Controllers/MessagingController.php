<?php

namespace App\Http\Controllers;

use App\Data\Messaging;
use App\Data\Zones;
use App\Group;
use App\MessageRecipient;
use App\SmsLog;
use App\SmsTopup;
use App\SmsUnit;
use App\Transformers\Messages\MessageTransformer;
use Illuminate\Http\Request;
use App\Data\Groups;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use \Response;
use DB;
use Yajra\Datatables\Datatables;

class MessagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repo;

    protected $paymentRepo;

    public function __construct()
    {
        $this->middleware('auth');
        $this->repo = new \App\Http\Controllers\api\MessagingController();
        $this->paymentRepo = new PaymentController();
    }

    public function outboxCount()
    {
        return $this->outbox(true);
    }

    public function pendingCount()
    {
        return $this->pending(true);
    }

    public function messagesByDay()
    {

        $messages = SmsLog::select('id', 'message', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->toFormattedDateString(); // grouping by years
            });


        $start = Carbon::now()->startOfMonth();

        $end = Carbon::now()->endOfMonth();

        $dates = [];

        while ($start->lte($end)) {
            $dates[] = Carbon::parse($start->copy())->toFormattedDateString();
            $start->addDay();
        }

        $labels = [];

        $values = [];

        $data = [];

        foreach ($messages as $key => $val) {
            $data[$key] = $val->count();
        }

        $count = -1;
        foreach ($dates as $key => $val) {

            $count += 1;

            array_push($labels, $val);

            isset($data[$val]) ? $values[$count] = $data[$val] : $values[$count] = 0;

        }

        $compiled = [];

        $compiled['labels'] = $labels;
        $compiled['data'] = $values;

        return ($compiled);

    }

    public function rechargeSms()
    {
        return view('messaging.recharge');
    }

    public function rechargeHistory()
    {
        $logs = SmsTopup::where('church_id', \auth()->user()->church_id)
            ->with('transaction')
            ->get();

        return view('messaging.recharge-history', compact('logs'));
    }

    public function recharge(Request $request)
    {
        $amount = $request->get('amount');

        $phone = $request->get('phone_number');

        $stkPush = $this->paymentRepo->push($phone, $amount);

        return $stkPush;

        return redirect()->back()->with(['success', 'Units added successfully']);

    }

    public function scheduleMessages(Request $request)
    {
        $this->repo->schedule($request->all());

        return redirect()->back()->with('success', 'Messages will be sent soon!');
    }

    public function removeScheduledMessage($id)
    {
        $message = MessageRecipient::find($id);

        if (!$message) {
            return redirect()->back()->with(['error' => 'Whoops! Message Not Found']);
        }

        $message->delete();

        return redirect()->back()->with(['success' => 'Message removed successfully']);
    }


    public function newMessage()
    {
        $user = \auth()->user();

        $groups = Group::where('church_id', $user->church_id)->get();

        $zones = Zones::where('church_id', $user->church_id)->get();

        $properties = app(MessageTransformer::class)->getColumnListing();

        return view('messaging.new-message', compact('groups', 'zones', 'properties'));
    }

    public function sms_logs()
    {
        return $this->repo->outbox();
    }

    public function outbox($count = false)
    {

        $user = \auth()->user();

        $logs = SmsLog::where('church_id', $user->church_id)->orderBy('tbl_sms_log.id', 'desc')->get();

        if ($count) {
            return $logs->count();
        }

        return view('messaging.outbox', compact('logs'));
    }

    public function pending($count = false)
    {

        $messages = MessageRecipient::with('message')->with('recipient')->get();

        if ($count) {
            return $messages->count();
        }
        return view('messaging.pending', compact('messages'));
    }

    public function index()
    {
        $members = DB::table('tbl_members')->get();
        $member_groups = Groups::all();
        $residentialareas = DB::table('tbl_residential_zones')->get();


        return view('messaging', compact('member_groups', 'residentialareas', 'members'));
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
        $messages = Messaging::create($request->all());
        return Response::json($messages);
    }

    public function allmessages()
    {
        $churchid = Auth::user()->church_id;

        $messages = DB::table('tbl_messages')
            ->leftJoin('tbl_members', 'tbl_members.id', '=', 'tbl_messages.added_by')
            ->select('tbl_messages.*', 'tbl_members.name')
            ->where('tbl_messages.church_id', $churchid)
            ->get();

        return Datatables::of($messages)
            ->addColumn('scheduled', function ($message) {
                return DB::table('tbl_message_recepient')->where('message_id', $message->id)->where('status', "Scheduled")->count();
            })
            ->addColumn('sent', function ($message) {
                return DB::table('tbl_message_recepient')->where('message_id', $message->id)->where('status', "Sent")->count();
            })
            ->addColumn('failed', function ($message) {
                return DB::table('tbl_message_recepient')->where('message_id', $message->id)->where('status', "Failed")->count();
            })
            ->addColumn('action', function ($message) {
                if ($message->status == "Scheduled") {
                    $sendbutton = '<a href="#send" title="Send" class="btn btn-success btn-sm" onclick="groups(' . "'" . $message->id . "'" . ')"> Send</a>';
                } else {
                    $sendbutton = "";
                }

                if ($message->status == "New Message") {
                    $recepientsbutton = '<a href="#recepients" title="Recepients" class="btn btn-success btn-sm" onclick="groups(' . "'" . $message->id . "'" . ')"> Recepients</a>';
                } else {
                    $recepientsbutton = "";
                }

                return '<a href="#edit-' . $message->id . '" class="btn btn-sm btn-primary" onclick="edit_member(' . "'" . $message->id . "'" . ')">Edit</a>
                    ' . $recepientsbutton . '
                    ' . $sendbutton . '';
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Data\messages $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messaging $messages, $id)
    {
        $data = Messaging::Where('id', $id)
            ->get();

        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Data\messages $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Data\messages $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Messaging::where('id', $id)
            ->update([
                'message_type' => $request->message_type,
                'message_content' => $request->message_content,
                'status' => $request->status,
            ]);
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Data\messages $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(messages $messages)
    {
        //
    }

    public function memberGroups($member_id = NULL)
    {

        $groups = DB::select("SELECT tbl_groups.id,tbl_groups.name,tbl_group_messages.status FROM tbl_groups
           LEFT JOIN tbl_group_messages ON tbl_group_messages.group_id = tbl_groups.id AND tbl_group_messages.member_id = '$member_id' ");

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
        $checkroute = DB::table('tbl_group_messages')
            ->where([
                ['member_id', '=', $user_id],
            ])
            ->update([
                'status' => '',
            ]);

        $variableAry = explode(",", $moduleData);
        foreach ($variableAry as $id) {
            $record = DB::table('tbl_group_messages')
                ->where([
                    ['member_id', '=', $user_id],
                    ['group_id', '=', $id],
                ])->count();

            if ($record == 0) {
                DB::table('tbl_group_messages')->insert([
                    ['member_id' => $user_id, 'group_id' => $id, 'status' => 'checked']
                ]);
            } else {
                $record = DB::table('tbl_group_messages')
                    ->where([
                        ['member_id', '=', $user_id],
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

    public function prepareUsers(Request $request)
    {
        $zones = $request->zones;
        $groups = $request->groups;
        $actionoption = $request->actionoption;
        $messagedata = DB::table('tbl_messages')->where('id', $request->message_id)->first();
        date_default_timezone_set("Africa/Nairobi");
        $datetimenow = date("Y-m-d H:i:s");

        if ($actionoption == 'check') {
            if ($request->usersoption == "groupusers") {
                $members = DB::table('tbl_members')
                    ->leftJoin('tbl_group_members', 'tbl_group_members.member_id', '=', 'tbl_members.id')
                    ->where(function ($members) use ($zones) {
                        if ($zones != NULL) {
                            foreach ($zones as $zone) {
                                $members = $members->orWhere('tbl_members.residence_zone', $zone);
                            }
                        }
                    })->where(function ($members) use ($groups) {
                        if ($groups != NULL) {
                            foreach ($groups as $group) {
                                $members = $members->orWhere('tbl_group_members.group_id', $group);
                            }
                        }
                    })->groupBy('tbl_members.id')->count();
            } else if ($request->usersoption == "all") {
                $members = DB::table('tbl_members')->count();
            } else {
                $members = count($request->users);
            }
        } else {

            if ($request->usersoption == "groupusers") {
                $members = DB::table('tbl_members')
                    ->leftJoin('tbl_group_members', 'tbl_group_members.member_id', '=', 'tbl_members.id')
                    ->where(function ($members) use ($zones) {
                        if ($zones != NULL) {
                            foreach ($zones as $zone) {
                                $members = $members->orWhere('tbl_members.residence_zone', $zone);
                            }
                        }
                    })->where(function ($members) use ($groups) {
                        if ($groups != NULL) {
                            foreach ($groups as $group) {
                                $members = $members->orWhere('tbl_group_members.group_id', $group);
                            }
                        }
                    })->groupBy('tbl_members.id')->get();
            } else if ($request->usersoption == "all") {
                $members = DB::table('tbl_members')->get();
            } else {
                $members = DB::table('tbl_members')
                    ->where(function ($members) use ($users) {
                        if ($users != NULL) {
                            foreach ($users as $user) {
                                $members = $members->orWhere('tbl_members.id', $user);
                            }
                        }
                    })->get();
            }
            if ($members != NULL) {
                foreach ($members as $member) {
                    DB::table('tbl_message_recepient')->insert([
                        ['member_id' => $member->id, 'message_id' => $request->message_id, 'message_content' => $messagedata->message_content, 'phone_number' => $member->phone_number, 'status' => 'Scheduled', 'scheduled_at' => $datetimenow]
                    ]);
                }
            }

            $members = DB::table('tbl_messages')
                ->where([
                    ['id', '=', $request->message_id]])
                ->update([
                    'status' => 'Scheduled',
                ]);

        }
        return response()->json($members);
    }

    public function available()
    {
        $churchId = \auth()->user()->church_id;
        $units = SmsUnit::where('church_id', $churchId)->first();
        if ($units) {
            return $units->units;
        }
        return 0;

    }
}
