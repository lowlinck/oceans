<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function block(Request $request, $type, $id)
    {
        dd(1111111);
        $model = $this->getModel($type);
        $model::blockById($id, $request->input('reason', 'Blocked by admin'));

        return response()->json(['status' => 'blocked']);
    }

    public function unblock($type, $id)
    {
        $model = $this->getModel($type);
        $model::unblockById($id);

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
