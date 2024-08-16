<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Http\Services\TodoService;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    protected $userId;
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->userId = Auth::id();
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = $this->todoService->getTodosForUser($this->userId);
        return TodoResource::collection($todos);
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = $this->todoService->createTodoForUser($request->validated(), $this->userId);
        return new TodoResource($todo);
    }

    public function show($id)
    {
        $todo = $this->todoService->getTodoById($id, $this->userId);

        if (!$todo) {
            return response()->json(['error' => 'Todo bulunamadı veya erişim hakkınız yok'], 403);
        }

        return new TodoResource($todo);
    }

    public function update(UpdateTodoRequest $request, $id)
    {
        $todo = $this->todoService->updateTodoForUser($request->validated(), $id, $this->userId);

        if (!$todo) {
            return response()->json(['error' => 'Todo bulunamadı veya erişim hakkınız yok'], 403);
        }

        return new TodoResource($todo);
    }

    public function destroy($id)
    {
        $result = $this->todoService->deleteTodoForUser($id, $this->userId);

        if (!$result) {
            return response()->json(['error' => 'Todo bulunamadı veya erişim hakkınız yok.'], 403);
        }

        return response()->json(null, 204);
    }
}
