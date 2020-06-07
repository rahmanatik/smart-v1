<?php

namespace App\Http\Controllers;

use App\Services\OrderStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class OrderStatusController extends Controller
{

    protected $orderStatusService;

    public function __construct(OrderStatusService $orderStatusService)
    {
        $this->orderStatusService = $orderStatusService;
    }

    public function findAll()
    {
        Log::debug('>>>>>>message');
        return response()->json($this->orderStatusService->findAll());
    }

    public function findById($id)
    {
        Log::debug('>>>>>>message' . $id);
        return response()->json($this->orderStatusService->findById($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            // 'orderStatus_name' => 'required|min:5',
            // 'password' => 'required|max:5',
            // 'body' => 'required',
        ]);

        $id = $this->orderStatusService->create($request);
        return response()->json(['id' => $id], 201);
    }

    public function update($id, Request $request)
    {
        $this->orderStatusService->update($id, $request);
        return response()->json('Successfuly Updeted', 200);
    }

    public function delete($id)
    {
        // $this->validate($id, [
        //     'id' => 'required',
        // ]);
        $this->orderStatusService->delete($id);
        return response('Successfuly Deleted', 204);
    }
}
