<?php

namespace Anchour\Blocks;

use Carbon_Fields\Block;

class BaseBlock
{
    protected static $instance;

    protected $block;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var string
     */
    protected $name = '';

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

    protected function setupFields()
    {
        $this->block = Block::make(__($this->name, 'anchour/blocks'));

        $this->block->add_fields($this->fields);
    }

}