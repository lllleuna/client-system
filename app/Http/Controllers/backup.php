<?php

public function restore($id)
{
    try {
        // Check each archive table one by one
        if ($archive = MemberArchive::find($id)) {
            DB::table('members_masterlist')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'firstname' => $archive->firstname,
                'middlename' => $archive->middlename,
                'lastname' => $archive->lastname,
                'sex' => $archive->sex,
                'role' => $archive->role,
                'email' => $archive->email,
                'mobile_no' => $archive->mobile_no,
                'birthday' => $archive->birthday,
                'joined_date' => $archive->joined_date,
                'address' => $archive->address,
                'sss_enrolled' => $archive->sss_enrolled,
                'pagibig_enrolled' => $archive->pagibig_enrolled,
                'philhealth_enrolled' => $archive->philhealth_enrolled,
                'employment_type' => $archive->employment_type,
                'share_capital' => $archive->share_capital,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $archive->delete();

        } elseif ($archive = UnitArchive::find($id)) {
            DB::table('coopunits')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'type' => $archive->type,
                'plate_no' => $archive->plate_no,
                'mv_file_no' => $archive->mv_file_no,
                'engine_no' => $archive->engine_no,
                'chassis_no' => $archive->chassis_no,
                'ltfrb_case_no' => $archive->ltfrb_case_no,
                'date_granted' => $archive->date_granted,
                'date_of_expiry' => $archive->date_of_expiry,
                'origin' => $archive->origin,
                'via' => $archive->via,
                'destination' => $archive->destination,
                'owned_by' => $archive->owned_by,
                'member_id' => $archive->member_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $archive->delete();

        } elseif ($archive = GovernanceArchive::find($id)) {
            DB::table('governance_list')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'firstname' => $archive->firstname,
                'middlename' => $archive->middlename,
                'lastname' => $archive->lastname,
                'sex' => $archive->sex,
                'role' => $archive->role,
                'email' => $archive->email,
                'mobile_no' => $archive->mobile_no,
                'birthday' => $archive->birthday,
                'start_term' => $archive->start_term,
                'end_term' => $archive->end_term,
                'address' => $archive->address,
                'sss_enrolled' => $archive->sss_enrolled,
                'pagibig_enrolled' => $archive->pagibig_enrolled,
                'philhealth_enrolled' => $archive->philhealth_enrolled,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $archive->delete();

        } elseif ($archive = DB::table('grant_archives')->where('id', $id)->first()) {
            DB::table('coop_grants_and_donations')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'date_acquired' => $archive->date_acquired,
                'amount' => $archive->amount,
                'source' => $archive->source,
                'status_remarks' => $archive->status_remarks,
                'file_upload' => $archive->file_upload,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('grant_archives')->where('id', $id)->delete();

        } elseif ($archive = DB::table('loan_archives')->where('id', $id)->first()) {
            DB::table('coop_loans')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'financing_institution' => $archive->financing_institution,
                'acquired_at' => $archive->acquired_at,
                'amount' => $archive->amount,
                'utilization' => $archive->utilization,
                'remarks' => $archive->remarks,
                'file_upload' => $archive->file_upload,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('loan_archives')->where('id', $id)->delete();

        } elseif ($archive = DB::table('business_archives')->where('id', $id)->first()) {
            DB::table('coop_businesses')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'type' => $archive->type,
                'nature_of_business' => $archive->nature_of_business,
                'starting_capital' => $archive->starting_capital,
                'capital_to_date' => $archive->capital_to_date,
                'years_of_existence' => $archive->years_of_existence,
                'status' => $archive->status,
                'remarks' => $archive->remarks,
                'file_upload' => $archive->file_upload,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('business_archives')->where('id', $id)->delete();

        } elseif ($archive = DB::table('training_archives')->where('id', $id)->first()) {
            DB::table('cooptrainings')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'title_of_training' => $archive->title_of_training,
                'start_date' => $archive->start_date,
                'end_date' => $archive->end_date,
                'no_of_attendees' => $archive->no_of_attendees,
                'total_fund' => $archive->total_fund,
                'remarks' => $archive->remarks,
                'total_members' => $archive->total_members,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('training_archives')->where('id', $id)->delete();

        } elseif ($archive = DB::table('award_archives')->where('id', $id)->first()) {
            DB::table('coopawards')->insert([
                'externaluser_id' => $archive->externaluser_id,
                'awarding_body' => $archive->awarding_body,
                'nature_of_award' => $archive->nature_of_award,
                'date_received' => $archive->date_received,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('award_archives')->where('id', $id)->delete();

        } else {
            return redirect()->back()->with('error', 'No archived record found with this ID.');
        }

        return redirect()->back()->with('success', 'Record restored successfully.');
    
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while restoring the record. Please try again.');
    }
}