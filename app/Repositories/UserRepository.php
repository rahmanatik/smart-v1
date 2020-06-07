<?php

namespace App\Repositories;

use App\Enums\UserStatusType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository
{

    public function findAll()
    {
        return DB::table('user')->get();
    }

    public function findById($id)
    {
        return DB::table('user')->where('id', '=', $id)->first();
    }

    public function create(Request $request)
    {
        Log::info(">>>>>>" . $request->update_by . "----" . config('app.name'));
        $now = Carbon::now();
        return DB::table('user')->insertGetId(
            [
                'user_name' => $request->user_name,
                'password' => $request->password,
                'user_status_type' => UserStatusType::ACTIVE,
                'hash_version' => $request->hash_version ? $request->hash_version : 1,
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
        DB::table('user')
            ->where('id', $id)
            ->update([
                'user_name' => $request->user_name,
                'password' => $request->password,
                'user_status_type' => $request->user_status_type,
                'hash_version' => $request->hash_version,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]);
    }

    public function delete($id)
    {
        DB::table('user')->where('id', '=', $id)->delete();
    }
}
