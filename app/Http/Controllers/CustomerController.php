<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{

    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function findAll()
    {
        Log::debug('>>>>>>message');
        return response()->json($this->customerService->findAll());
    }

    public function findById($id)
    {
        Log::debug('>>>>>>message' . $id);
        return response()->json($this->customerService->findById($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            // 'Customer_name' => 'required|min:5',
            // 'password' => 'required|max:5',
            // 'body' => 'required',
        ]);

        $id = $this->customerService->create($request);
        return response()->json(['id' => $id], 201);
    }

    public function update($id, Request $request)
    {
        $customer = $this->customerService->update($id, $request);
        return response()->json($customer, 200);
    }

    public function delete($id)
    {
        $this->validate($id, [
            'id' => 'required',
        ]);
        $this->customerService->delete($id);
        return response('Deleted Successfully', 204);
    }
}
