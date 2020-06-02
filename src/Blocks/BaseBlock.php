<?php

namespace Anchour\Blocks\Blocks;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

use function Anchour\Blocks\view;

abstract class BaseBlock
{
    /**
     * Singleton instance.
     *
     * @var BaseBlock
     */
    protected static $instance;

    /**
     * @var Carbon_Fields\Container\Container
     */
    protected $block;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var string
     */
    protected $name = '';

    /**
     * Singleton instance, so we can't register the same block more than once.
     *
     * @return BaseBlock
     */
    public static function register()
    {
        return new static;
    }

    public function setup()
    {
        $this->block = Block::make(__($this->name, 'anchour/blocks'));

        $this->block
            ->add_fields($this->makeFields($this->fields))
            ->set_description($this->description)
            ->set_render_callback([$this, 'render']);

        if (isset($this->isNestable) && $this->isNestable) {
            $this->block->set_inner_blocks(true)->set_inner_blocks_template([
                ['carbon-fields/cta-block']
            ]);
        }

        return $this;
    }


    abstract public function render($fields, $attributes, $inner_blocks);

    /**
     * @return array
     */
    protected function makeFields($fields)
    {
        return collect($fields)
            ->map(function ($field) {
                if ($field['type'] == 'complex') {
                    return Field::make('complex', $field['name'])->add_fields($this->makeFields($field['children']));
                }

                $fieldObj = Field::make(
                    $field['type'],
                    $field['name'],
                    $field['label']
                );

                // if (isset($field['set_value_type'])) {
                //     dd(method_exists($fieldObj, 'set_value_type'));
                //     $fieldObj->set_value_type($field['set_value_type']);
                // }

                return $fieldObj;
            })->toArray();
    }

    protected function blockName()
    {
        $name = preg_replace('/[^A-Za-z0-9\-\_\s]/', '', $this->name);
        $name = strtolower($name);
        $name = str_replace(['-', ' '], '_', $name);

        return $name;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields = [])
    {
        $this->fields = $fields;
    }
}
