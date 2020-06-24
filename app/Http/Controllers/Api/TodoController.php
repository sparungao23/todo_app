<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Todo;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }
    
    public function store(Request $request) 
    {
        $response = Todo::create($request->all());

        if($response) {
            return TodoResource::collection(Todo::all());
        }

        return response()->json([
            'errors' => [
                'status' => 422,
                'title' => 'Forbidden',
                'detail' => 'Unable to process request.',
            ],
        ], 403);
    }

    public function delete($id) 
    {
        $response = Todo::find($id)->delete();
        
        if($response) {
            return TodoResource::collection(Todo::all());
        }

        return response()->json([
            'errors' => [
                'status' => 422,
                'title' => 'Forbidden',
                'detail' => 'Unable to process request.',
            ],
        ], 403);
    }
}
