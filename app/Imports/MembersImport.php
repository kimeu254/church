<?php

namespace App\Imports;

use App\Data\Groups;
use App\Data\Members;
use App\Data\Zones;
use App\GroupMember;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MembersImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $church_id = auth()->user()->church_id;

        $zone = $row[8];

        $zoneDetails = Zones::where('zone_name', $zone)->first();

        if ($zoneDetails) {
            $zone = $zoneDetails->id;
        } else {
            $zone = null;
        }

        $spouseNationalID = $row[12];

        $spouseDetails = Members::where('national_id', $spouseNationalID)->first();

        if ($spouseDetails) {
            $spouseNationalID = $spouseDetails->national_id;
        } else {
            $spouseNationalID = null;
        }

        $member = ([
            //
            'church_id' => $church_id,
            'membership_number' => $row[0],
            'name' => $row[1],
            'gender' => $row[2],
            'email' => $row[3],
            'phone_number' => $row[4],
            'password' => Hash::make($row[5]), // national id
            'marital_status' => $row[6],
            'national_id' => $row[5],
            'married_in_church' => $row[7],
            'residence_zone' => $zone,
            'former_church' => $row[9],
            'baptized' => $row[10],
            'confirmed' => $row[11],
            'spouse' => $spouseNationalID,
            'groups' => $row[13],
            'status' => 'Active'
        ]);

        // find out if the member is already in the database...
        $groups = explode(',', $member['groups']);

        $exists = Members::where('national_id', $row[5])->first();

        if ($exists) {
            $exists->update($member);
            $member = $exists;
        } else {
            $member = Members::create($member);
        }

        foreach ($groups as $group) {

            $group = Groups::where('church_id', $church_id)->where('name', $group)->first();

            if ($group) {

                $group_member = GroupMember::where('member_id', $member->id)->where('group_id', $group->id)->first();

                if (!$group_member) {
                    GroupMember::create([
                        'member_id' => $member->id,
                        'group_id' => $group->id,
                        'status' => 'checked'
                    ]);
                }
            }
        }

        return null;

    }
}
