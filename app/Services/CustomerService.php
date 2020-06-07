<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function findAll()
    {
        return $this->customerRepository->findAll();
    }

    public function findById($id)
    {
        return $this->customerRepository->findById($id);
    }

    public function create(Request $request)
    {
        return $this->customerRepository->create($request);
    }

    public function update($id, Request $request)
    {
        $this->customerRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->customerRepository->delete($id);
    }
}
