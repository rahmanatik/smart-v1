<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryRepository
{
    public function create($request)
    {
        Log::info(">>>>>>" . $request->update_by . "----" . config('app.name'));
        $now = Carbon::now();
        return DB::table('category')->insertGetId(
            [
                'parent_id' => $request->parent_id,
                'category_name' => $request->category_name,
                'level' => $request->level,
                'created_at' => $now,
                'created_by' => $request->created_by ? $request->created_by : config('app.name'),
                'updated_at' => $now,
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]
        );
    }

    public function update($id, $request)
    {
        Log::info('message>>>' . $request);
        DB::table('category')
            ->where('id', $id)
            ->update([
                'parent_id' => $request->parent_id,
                'category_name' => $request->category_name,
                'level' => $request->level,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]);
    }

    public function delete($id)
    {
        DB::table('category')->where('id', '=', $id)->delete();
    }

    public function findAll($request)
    {
        $query = DB::table('category');

        if ($request->get('category_name') != null) $query->where('category_name', 'like', '%' . $request->get('category_name') . '%');

        return $query->get();
    }

    public function findById($id)
    {
        return DB::table('category')->where('id', '=', $id)->first();
    }

    //TODO:: create has to be more intelligent
    public function findByCategoryNameOrCreate($request)
    {
        $category = DB::table('category')->where('category_name', $request->category_name)->first();
        if ($category == null) {
            $request->parent_id = null;
            $request->level = 1;
            $categoryId = $this->create($request);
            $category = $this->findById($categoryId);
        }

        return $category;
    }
}
