<?php

namespace App\Http\Controllers;

use App\Services\OrderItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class OrderItemController extends Controller
{

    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function findAll()
    {
        Log::debug('>>>>>>message');
        return response()->json($this->orderItemService->findAll());
    }

    public function findById($id)
    {
        Log::debug('>>>>>>message' . $id);
        return response()->json($this->orderItemService->findById($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            // 'orderItem_name' => 'required|min:5',
            // 'password' => 'required|max:5',
            // 'body' => 'required',
        ]);

        $id = $this->orderItemService->create($request);
        return response()->json(['id' => $id], 201);
    }

    public function update($id, Request $request)
    {
        $this->orderItemService->update($id, $request);
        return response()->json('Successfuly Updeted', 200);
    }

    public function delete($id)
    {
        // $this->validate($id, [
        //     'id' => 'required',
        // ]);
        $this->orderItemService->delete($id);
        return response('Successfuly Deleted', 204);
    }
}
