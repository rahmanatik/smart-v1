<?php

namespace App\Repositories;

use App\Enums\OrderType;
use App\Enums\DeliveryType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderItemRepository
{

    public function findAll()
    {
        return DB::table('order_item')->get();
    }

    public function findById($id)
    {
        return DB::table('order_item')->where('id', '=', $id)->first();
    }

    public function create(Request $request)
    {
        Log::info(">>>>>>" . $request->update_by . "----" . config('app.name'));
        $now = Carbon::now();
        return DB::table('order_item')->insertGetId(
            [
                'order_id' => $request->order_id,
                'item_id' => $request->item_id,
                'description' => $request->description,
                'line' => $request->line,
                'quantity_purchased' => $request->quantity_purchased,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
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
        DB::table('order_item')
            ->where('id', $id)
            ->update([
                'order_id' => $request->order_id,
                'item_id' => $request->item_id,
                'description' => $request->description,
                'line' => $request->line,
                'quantity_purchased' => $request->quantity_purchased,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]);
    }

    public function delete($id)
    {
        DB::table('order_item')->where('id', '=', $id)->delete();
    }
}
