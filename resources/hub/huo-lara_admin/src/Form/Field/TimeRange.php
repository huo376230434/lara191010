<?php

namespace Huojunhao\LaraAdmin\Form\Field;

class TimeRange extends DateRange
{
    use CommonTrait;

    protected $format = 'HH:mm:ss';
}
