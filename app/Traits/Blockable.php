<?php
// app/Traits/Blockable.php
namespace App\Traits;

trait Blockable
{
    public static function blockById($id, $reason)
    {
        $model = self::findOrFail($id);
        $model->is_blocked = true;
        $model->blocked_reason = $reason;
        $model->save();
    }

    public static function unblockById($id)
    {
        $model = self::findOrFail($id);
        $model->is_blocked = false;
        $model->blocked_reason = null;
        $model->save();
    }

    public function isBlocked()
    {
        return $this->is_blocked;
    }
}
