<?php

namespace App\Repositories;

use App\Enums\OrderType;
use App\Enums\DeliveryType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository
{

    public function findAll()
    {
        return DB::table('order')->get();
    }

    public function findById($id)
    {
        return DB::table('order')->where('id', '=', $id)->first();
    }

    public function create(Request $request)
    {
        Log::info(">>>>>>" . $request->update_by . "----" . config('app.name'));
        $now = Carbon::now();
        return DB::table('order')->insertGetId(
            [
                'customer_id' => $request->customer_id,
                'user_id' => $request->user_id,
                'order_date' => $now,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => $request->delivery_address,
                'delivery_type' => $request->delivery_type ? $request->delivery_type : DeliveryType::HOME,
                'comment' => $request->comment,
                'order_type' => $request->sale_type ? $request->sale_type : OrderType::SALE,
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
        DB::table('order')
            ->where('id', $id)
            ->update([
                'customer_id' => $request->customer_id,
                'user_id' => $request->user_id,
                'delivery_date' => $request->delivery_date,
                'delivery_address' => $request->delivery_address,
                'delivery_type' => $request->delivery_type,
                'comment' => $request->comment,
                'order_type' => $request->sale_type,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]);
    }

    public function delete($id)
    {
        DB::table('order')->where('id', '=', $id)->delete();
    }

    public function findDetailById($id)
    {
        return DB::table('order AS o')
        ->join('order_item AS oi', 'o.id', '=', 'oi.order_id')
        ->join('order_status AS os', 'o.id', '=', 'os.order_id')
        ->select('o.*', 'oi.*', 'os.*')
        ->where('o.id', '=', $id)
        ->get();
    }
}
