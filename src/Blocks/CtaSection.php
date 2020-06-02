<?php

namespace Anchour\Blocks\Blocks;

use Anchour\Blocks\Traits\Nestable;

use function App\template;

class CtaSection extends BaseBlock
{
    use Nestable;

    protected $name = 'CTA Section';

    protected $description = 'Houses nested CTA blocks.';

    protected $allowedNestedBlocks = [
        'carbon-fields/cta-block',
    ];

    public function render($fields, $attributes, $inner_blocks)
    {
        echo template('blocks.cta-section', compact('fields', 'attributes', 'inner_blocks'));
    }
}
