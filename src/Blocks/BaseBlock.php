<?php

namespace Anchour\Blocks\Blocks;

use Carbon_Fields\Block;

class BaseBlock
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
     * BaseBlock constructor. Protected so it's a singleton.
     */
    protected function __construct()
    {
    }

    /**
     * Singleton instance, so we can't register the same block more than once.
     *
     * @return BaseBlock
     */
    public static function register()
    {
        if (is_null(static::$instance)) {
            static::$instance = new BaseBlock();
        }

        return static::$instance;
    }

    public function setup()
    {
        $this->block = Block::make(__($this->name, 'anchour/blocks'));

        $this->block
            ->add_fields($this->makeFields())
            ->set_description("Field description here")
            ->set_render_callback([$this, 'render']);

        return $this;
    }

    protected function render()
    {
        echo $this->name;
    }

    /**
     * @return array
     */
    protected function makeFields()
    {
        return collect($this->fields)
            ->map(function ($field) {
                return Field::make(
                    $field['type'],
                    $field['name'],
                    $field['label']
                );
            })->toArray();
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields = [])
    {
        $this->fields = $fields;
    }
}