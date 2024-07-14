<?php

namespace App\Http\Controllers\Subtitle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApiController extends Controller
{

        public function store(Request $request)
    {
        $data = $request->all();
        $message = 'Data received successfully';
        // Обработка данных
        // Например, можно сохранить данные в базу данных

        // Возврат представления с данными
        return inertia('Category/Stores', compact('data','message'));


    }
}
