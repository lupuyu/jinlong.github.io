<?php
namespace app\index\model;

use think\Model;

class Kaoqin extends Model
{
    // 开启自动写入时间戳

    public function kaoqin()
    {
        return $this->belongsTo('kechengbiao');
    }
}
