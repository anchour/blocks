<?php

namespace Anchour\Blocks;

use Carbon_Fields\Field\Field;

class OneColumnText extends BaseBlock
{
    protected $name = 'One Column Text';

    protected $fields = [
        [
            'type' => 'text',
            'name' => 'title',
            'label' => 'Title',
        ]
    ];

}