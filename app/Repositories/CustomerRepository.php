<?php

namespace App\Repositories;

use App\Enums\CustomerStatusType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerRepository
{

    public function findAll()
    {
        return DB::table('customer')->get();
    }

    public function findById($id)
    {
        return DB::table('customer')->where('id', '=', $id)->first();
    }

    public function create(Request $request)
    {
        $now = Carbon::now();
        return DB::table('customer')->insertGetId(
            [
                'user_id' => $request->user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'zip' => $request->zip,
                'customer_status_type' => CustomerStatusType::ACTIVE,
                'created_at' => $now,
                'created_by' => $request->created_by ? $request->created_by : config('app.name'),
                'updated_at' => $now,
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]
        );
    }

    public function update($id, Request $request)
    {
        Log::info('message>>>' . $request);
        DB::table('customer')
            ->where('id', $id)
            ->update([
                'user_id' => $request->user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'zip' => $request->zip,
                'customer_status_type' => $request->customer_status_type,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]);
    }
    public function delete($id)
    {
        DB::table('customer')->where('id', '=', $id)->delete();
    }
}
