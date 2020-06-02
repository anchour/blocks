<?php

namespace Anchour\Blocks\Blocks;

use Anchour\Blocks\Traits\Repeatable;

use function App\template;

class CtaBlock extends BaseBlock
{
    use Repeatable;

    protected $name = 'CTA Block';

    protected $description = 'Block with title, description, and link.';

    protected $view = 'blocks.cta-block';

    protected $fields = [
        [
            'type' => 'text',
            'name' => 'title',
            'label' => 'Title',
        ],
        [
            'type' => 'text',
            'name' => 'description',
            'label' => 'Description',
        ],
        [
            'type' => 'text',
            'name' => 'link',
            'label' => 'Link',
            'set_value_type' => 'url',
        ]
    ];

    public function render($fields, $attributes, $inner_blocks)
    {
        ob_start();

        foreach ($fields['cta_block'] as $field) {
            echo template($this->view, $field);
        }

        echo ob_get_clean();
    }
}
