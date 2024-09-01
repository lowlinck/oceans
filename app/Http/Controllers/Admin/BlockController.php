<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function block(Request $request, $type, $id)
    {

        $model = $this->getModel($type);
        $record = $model::find($id);

        if (!$record) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $record->is_blocked = true; // предположим, что у модели есть поле is_blocked
        $record->blocked_reason = $request->input('reason', 'Blocked by admin');
        $record->save();

        return response()->json(['status' => 'blocked']);
    }

    public function unblock($type, $id)
    {
        $model = $this->getModel($type);
        $record = $model::find($id);

        if (!$record) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $record->is_blocked = false;
        $record->blocked_reason = null; // очищаем причину блокировки, если нужно
        $record->save();

        return response()->json(['status' => 'unblocked']);
    }
    protected function getModel($type)
    {
        $models = [
            'posts' => \App\Models\Post::class,
            'comments' => \App\Models\Comment::class,
            // добавьте здесь другие модели по мере необходимости
        ];

        if (!array_key_exists($type, $models)) {
            abort(404, "Модель не найдена.");
        }

        return $models[$type];
    }
}
