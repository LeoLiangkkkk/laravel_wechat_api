<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $cid
 * @property string $name
 * @property string $uid
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $qa_status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lesson whereQaStatus($value)
 */
class Lesson extends Model
{
    public const STATUS_DONE = 0; //考勤结束
    public const STATUS_NOW = 1; //正在考勤

    public const QA_STATUS_DONE = 0; //提问结束
    public const QA_STATUS_NOW = 1; //正在提问

    public const PREFIX = 'C';

    protected $fillable = [
        'cid', 'name', 'uid', 'status', 'qa_status'
    ];

    protected $hidden = [];

    public static function getCid()
    {
        $model = self::orderBy('created_at', 'DESC')->first('cid');

        if ($model === null) {
            return self::PREFIX.'00000001';
        }

        $cid = (string)(substr($model->cid, 1) + 1);

        return self::PREFIX.str_pad($cid, 8, '0', STR_PAD_LEFT);
    }

    public function isSignInNow()
    {
        return $this->status === self::STATUS_NOW;
    }

    public function isMyLesson($uid)
    {
        return $this->uid === $uid;
    }
}
