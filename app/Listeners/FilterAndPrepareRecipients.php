<?php

namespace App\Listeners;

use App\Data\Members;
use App\Events\PrepareRecipients;
use App\GroupMember;
use App\MessageRecipient;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class FilterAndPrepareRecipients
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PrepareRecipients $event
     * @return void
     */
    public function handle(PrepareRecipients $event)
    {
        //
        $message = $event->message;

        $filters = $event->filters;

        $groups = isset($filters['groups']) ? $filters['groups'] : '';

        $zones = isset($filters['zones']) ? $filters['zones'] : [];

        $gender = isset($filters['gender']) ? $filters['gender'] : [];

        $members = $this->memberGroups($groups)->get();


        $members = $members->filter(function ($member) use ($zones, $gender) {

            if (empty($zones) && empty($gender)) {
                return $member;
            }

            if (!empty($zones) && !empty($gender)) {
                if (in_array($member->gender, $gender) && in_array($member->residence_zone, $zones)) {
                    return $member;
                }
            } else if (!empty($zones) && empty($gender)) {
                if (in_array($member->residence_zone, $zones)) {
                    return $member;
                }
            } else if (empty($zones) && !empty($gender)) {
                if (in_array($member->gender, $gender)) {
                    return $member;
                }
            }
//            else {
////                return $member;
//            }
        });

        // save recipients...

        foreach ($members as $member) {

            $data = [];

            $data['message_id'] = $message->id;

            $data['member_id'] = $member->id;

            $data['status'] = true;

            MessageRecipient::create($data);

        }

    }

    public function memberGroups($ids)
    {
        $user = auth()->user();

        if (empty($ids)) {
            return Members::where('church_id', $user->church_id);
        }

        $memberIds = GroupMember::whereIn('group_id', $ids)->get()->pluck('member_id')->toArray();

        return Members::whereIn('id', $memberIds);
    }
}
