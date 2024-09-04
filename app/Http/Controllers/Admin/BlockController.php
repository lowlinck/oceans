<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function toggleBlock(Request $request, $type, $id)
    {
        $model = $this->getModel($type);
        $record = $model::find($id);

        if (!$record) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        // Обновляем поле is_blocked в зависимости от переданного значения
        $record->is_blocked = $request->input('is_blocked');
        $record->blocked_reason = $request->input('reason', $record->is_blocked ? 'Blocked by admin' : null);
        $record->save();

        return response()->json(['status' => $record->is_blocked ? 'blocked' : 'unblocked']);
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
