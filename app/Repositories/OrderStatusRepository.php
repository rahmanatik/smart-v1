<?php

namespace App\Repositories;

use App\Enums\OrderType;
use App\Enums\DeliveryType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderStatusRepository
{

    public function findAll()
    {
        return DB::table('order_status')->get();
    }

    public function findById($id)
    {
        return DB::table('order_status')->where('id', '=', $id)->first();
    }

    public function create(Request $request)
    {
        Log::info(">>>>>>" . $request->update_by . "----" . config('app.name'));
        $now = Carbon::now();
        return DB::table('order_status')->insertGetId(
            [
                'order_id' => $request->order_id,
                'status_type' => $request->status_type,
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
        DB::table('order_status')
            ->where('id', $id)
            ->update([
                'order_id' => $request->order_id,
                'status_type' => $request->status_type,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]);
    }

    public function delete($id)
    {
        DB::table('order_status')->where('id', '=', $id)->delete();
    }
}
