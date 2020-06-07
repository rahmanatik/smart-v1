<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function findAll(Request $request)
    {
        Log::debug('>>>>>>message');
        return response()->json($this->categoryService->findAll($request));
    }

    public function findById($id)
    {
        Log::debug('>>>>>>message' . $id);
        return response()->json($this->categoryService->findById($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            // 'category_name' => 'required|min:5',
            // 'password' => 'required|max:5',
            // 'body' => 'required',
        ]);

        $id = $this->categoryService->create($request);
        return response()->json(['id' => $id], 201);
    }

    public function update($id, Request $request)
    {
        $this->categoryService->update($id, $request);
        return response()->json('Successfuly Updeted', 200);
    }

    public function delete($id)
    {
        // $this->validate($id, [
        //     'id' => 'required',
        // ]);
        $this->categoryService->delete($id);
        return response('Successfuly Deleted', 204);
    }
}
