<?php

namespace Huojunhao\LaraAdmin\Form\Field;

class DatetimeRange extends DateRange
{
    use CommonTrait;

    protected $format = 'YYYY-MM-DD HH:mm:ss';
}
