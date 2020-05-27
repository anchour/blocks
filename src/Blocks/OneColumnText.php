<?php

namespace Anchour\Blocks\Blocks;

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