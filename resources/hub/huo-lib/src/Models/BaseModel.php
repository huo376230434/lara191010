<?php

namespace Huojunhao\Lib\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = [];
    use BaseModelTrait;

}
