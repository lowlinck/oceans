<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeApiController extends Command
{
protected $signature = 'make:api-controller {name} {--model=}';
protected $description = 'Create a new API controller with a corresponding request class';

public function handle()
{
$name = $this->argument('name');
$model = $this->option('model');

// Создание контроллера
$this->call('make:controller', [
'name' => "Api/$name" . 'Controller',
'--api' => true,
'--model' => $model ? "Models/$model" : null
]);

// Путь и имя для Request класса
$requestPath = "Http/Requests/Api/" . Str::singular($model);
$requestName = $model . 'Request';

// Создание директории, если она не существует
if (!file_exists(app_path($requestPath))) {
mkdir(app_path($requestPath), 0755, true);
}

// Создание Request класса
file_put_contents(app_path("$requestPath/$requestName.php"), $this->generateRequestContent($model));

$this->info("ApiController and corresponding Request have been created.");
}

protected function generateRequestContent($model)
{
return "<?php

namespace App\Http\Requests\Api\\" . Str::singular($model) . ";

use Illuminate\Foundation\Http\FormRequest;

class " . $model . "Request extends FormRequest
{
    public function authorize()
{
    return true;
}

    public function rules()
{
    return [
        // Ваши правила валидации
    ];
}
}";
    }
}
