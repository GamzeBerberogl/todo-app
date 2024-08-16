<?php

namespace App\Http\Services;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

class TodoService
{
    // auth kullanıcının tüm todo'ları
    public function getTodosForUser(int $userId): Collection
    {
        return Todo::where('user_id', $userId)->get();
    }

    // auth kullanıcı yeni todo
    public function createTodoForUser(array $data, int $userId): Todo
    {
        $data['user_id'] = $userId;
        return Todo::create($data);
    }

    // auth kullanıcının x todo'su
    public function getTodoById(int $id, int $userId): ?Todo
    {
        return Todo::where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function updateTodoForUser(array $data, int $id, int $userId): ?Todo
    {
        $todo = $this->getTodoById($id, $userId);

        if ($todo) {
            $todo->update($data);
        }

        return $todo;
    }

    public function deleteTodoForUser(int $id, int $userId): bool
    {
        $todo = $this->getTodoById($id, $userId);

        if ($todo) {
            return $todo->delete();
        }

        return false;
    }
}
