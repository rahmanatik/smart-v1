<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemRepository
{

    public function create(Request $request)
    {
        Log::info(">>>>>>" . $request->update_by . "----" . config('app.name'));
        $now = Carbon::now();
        return DB::table('item')->insertGetId(
            [
                'category_id' => $request->category_id,
                'item_name' => $request->item_name,
                'item_number' => $request->item_number,
                'description' => $request->description,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'quantity' => $request->quantity ? $request->quantity : 0,
                'deleted' => $request->deleted ? $request->deleted : 'N',
                'online' => $request->online ? $request->online : 'N',
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
        DB::table('item')
            ->where('id', $id)
            ->update([
                'category_id' => $request->category_id,
                'item_name' => $request->item_name,
                'item_number' => $request->item_number,
                'description' => $request->description,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'quantity' => $request->quantity,
                'deleted' => $request->deleted,
                'online' => $request->online,
                'updated_at' => Carbon::now(),
                'updated_by' => $request->update_by ? $request->update_by : config('app.name'),
            ]);
    }

    public function delete($id)
    {
        DB::table('item')->where('id', '=', $id)->delete();
    }

    public function findAll()
    {
        return DB::table('item')->get();
    }

    public function findById($id)
    {
        return DB::table('item')->where('id', '=', $id)->first();
    }

    public function findAllDetails(Request $request)
    {

        $query = DB::table('item')
            ->leftjoin('image', 'item.id', '=', 'image.item_id')
            ->leftjoin('category', 'item.category_id', '=', 'category.id')
            ->select(
                'item.*',
                'image.id as image_id',
                'image.image_url',
                'category.parent_id as category_parent_id',
                'category.category_name',
                'category.level as category_level'
            );

        if ($request->get('item_id') != null) $query->where('item_id', $request->get('item_id'));
        if ($request->get('item_name') != null) $query->where('item.item_name', 'like', '%' . $request->get('item_id') . '%');
        if ($request->get('category_id') != null) $query->where('item.category_id', $request->get('category_id'));
        if ($request->get('category_name') != null) $query->where('category.category_name', 'like', '%' . $request->get('category_name') . '%');

        return $this->mapItems($query->paginate(15));
    }

    public function findDetailsById($id)
    {
        $rows = DB::table('item')
            ->leftjoin('image', 'item.id', '=', 'image.item_id')
            ->leftjoin('category', 'item.category_id', '=', 'category.id')
            ->where('item.id', '=', $id)
            ->select(
                'item.*',
                'image.id as image_id',
                'image.image_url',
                'category.parent_id as category_parent_id',
                'category.category_name',
                'category.level as category_level'
            )
            ->get();

        return $this->mapItems($rows)[0];
    }

    public function findDetailsByName($itemName)
    {
        $rows = DB::table('item')
            ->leftjoin('image', 'item.id', '=', 'image.item_id')
            ->leftjoin('category', 'item.category_id', '=', 'category.id')
            ->where('item.item_name', 'like', '%' . $itemName . '%')
            ->select(
                'item.*',
                'image.id as image_id',
                'image.image_url',
                'category.parent_id as category_parent_id',
                'category.category_name',
                'category.level as category_level'
            )
            ->get();

        return $this->mapItems($rows);
    }

    private function mapItems($rows)
    {
        $items = [];
        foreach ($rows as $row) {
            $id = $row->id;
            if (!isset($items[$id])) {
                $items[$id] = [
                    'id' => $id,
                    'category_id' => $row->category_id,
                    'item_name' => $row->item_name,
                    'item_number' => $row->item_number,
                    'description' => $row->description,
                    'purchase_price' => $row->purchase_price,
                    'sale_price' => $row->sale_price,
                    'quantity' => $row->quantity,
                    'deleted' => $row->deleted,
                    'online' => $row->online,
                    'created_at' => $row->created_at,
                    'created_by' => $row->created_by,
                    'updated_at' => $row->updated_at,
                    'updated_by' => $row->updated_by,
                    'images' => [],
                    'category' => [],
                ];
            }

            $items[$id]['images'][] = [
                'id' => $row->image_id,
                'image_url' => $row->image_url,
            ];

            $items[$id]['category'] = [
                'id' => $row->category_id,
                'category_name' => $row->category_name,
                'parent_id' => $row->category_parent_id,
                'level' => $row->category_level,
            ];
        }

        return collect($items)->values()->all();
    }
}
