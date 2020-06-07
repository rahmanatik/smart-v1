<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ItemController extends Controller
{

    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function create(Request $request)
    {
        //@Validated
        $this->validate($request, [
            // 'item_name' => 'required|min:5',
            // 'password' => 'required|max:5',
            // 'body' => 'required',
            'category_id' => 'required_without_all:category_name', //@Validated category_id || category_name
            'category_name' => 'required_without_all:category_id',
        ]);

        // if ($request->category_id == null) {
        //     if ($request->category_name == null) throw new \Exception('Bad Reqest: category Name/Id missing');

        $id = $this->itemService->create($request);
        return response()->json(['id' => $id], 201);
    }

    public function update($id, Request $request)
    {
        $this->itemService->update($id, $request);
        return response()->json('Successfuly Updeted', 200);
    }

    public function delete($id)
    {
        // $this->validate($id, [
        //     'id' => 'required',
        // ]);
        $this->itemService->delete($id);
        return response('Successfuly Deleted', 204);
    }

    public function findAll()
    {
        Log::debug('>>>>>>message');
        return response()->json($this->itemService->findAll());
    }

    public function findById($id)
    {
        Log::debug('>>>>>>message' . $id);
        return response()->json($this->itemService->findById($id));
    }

    public function findAllDetails(Request $request)
    {
        Log::debug('>>>>>>message');
        return response()->json($this->itemService->findAllDetails($request));
    }

    public function findDetailsById($id)
    {
        Log::debug('>>>>>>message');
        return response()->json($this->itemService->findDetailsById($id));
    }

    public function findDetailsByName($item_name)
    {
        Log::debug('>>>>>>message');
        return response()->json($this->itemService->findDetailsByName($item_name));
    }
}
