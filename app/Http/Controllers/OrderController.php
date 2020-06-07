<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function findAll()
    {
        Log::debug('>>>>>>message');
        return response()->json($this->orderService->findAll());
    }

    public function findById($id)
    {
        Log::debug('>>>>>>message' . $id);
        return response()->json($this->orderService->findById($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            // 'order_name' => 'required|min:5',
            // 'password' => 'required|max:5',
            // 'body' => 'required',
        ]);

        $id = $this->orderService->create($request);
        return response()->json(['id' => $id], 201);
    }

    public function update($id, Request $request)
    {
        $this->orderService->update($id, $request);
        return response()->json('Successfuly Updeted', 200);
    }

    public function delete($id)
    {
        // $this->validate($id, [
        //     'id' => 'required',
        // ]);
        $this->orderService->delete($id);
        return response('Successfuly Deleted', 204);
    }
}
