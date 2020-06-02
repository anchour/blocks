<?php

namespace Anchour\Blocks\Traits;

use Carbon_Fields\Field;

trait Repeatable
{
    protected $layout = 'tabbed-vertical';

    /**
     * @return array
     */
    protected function makeFields($fields)
    {

        $name = $this->blockName();

        return [Field::make('complex', $name)->set_layout($this->layout)->add_fields(parent::makeFields($fields))];
    }
}
