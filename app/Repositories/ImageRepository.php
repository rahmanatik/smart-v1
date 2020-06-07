<?php

namespace App\Repositories;

use App\Enums\ImageType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImageRepository
{

    public function findAll()
    {
        return DB::table('image')->get();
    }

    public function findById($id)
    {
        return DB::table('image')->where('id', '=', $id)->first();
    }

    public function create(Request $request)
    {
        Log::info(">>>>>>" . $request->update_by . "----" . config('app.name'));
        $now = Carbon::now();
        return DB::table('image')->insertGetId(
            [
                'item_id' => $request->item_id,
                'image_url' => $request->image_url,
                'image_type' => $request->image_type ? $request->image_type : ImageType::FRONT,
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
        DB::table('image')
            ->where('id', $id)
            ->update([
                'item_id' => $request->item_id,
                'image_url' => $request->image_url,
                'image_type' => $request->image_type,
                'updated_at' => Carbon::now(),
                'updated_by' =>$request->update_by ? $request->update_by : config('app.name'),
            ]);
    }

    public function delete($id)
    {
        DB::table('image')->where('id', '=', $id)->delete();
    }
}
