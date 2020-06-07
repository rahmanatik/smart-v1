<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findAll()
    {
        // return $this->userRepository->findAll();
        return User::all();
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create(Request $request)
    {
        return $this->userRepository->create($request);
    }

    public function update($id, Request $request)
    {
        $this->userRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);
    }
}
