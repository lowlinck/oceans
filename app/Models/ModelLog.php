<?php

namespace App\Models;

use App\Traits\LogsModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelLog extends Model
{
    use HasFactory, SoftDeletes ;
    protected $fillable = ['model', 'model_id', 'operation', 'data'];

    /**
     * Log the operation.
     *
     * @param string $model
     * @param int $modelId
     * @param string $operation
     * @param array $data
     */
    public static function log(string $model, int $modelId, string $operation, array $data): void
    {
        self::create([
            'model' => $model,
            'model_id' => $modelId,
            'operation' => $operation,
            'data' => json_encode($data),
        ]);
    }
}
