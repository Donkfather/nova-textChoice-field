<?php

namespace Donkfather\TextChoice;

use Laravel\Nova\Fields\Field;

class TextChoice extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'text-choice';

    /**
     * This is a key => value pair of the value => label for the radios.
     *
     * @param mixed $options
     * @return TextChoice
     */
    public function options(array $options)
    {
        $this->withMeta(['options' => $options]);

        return $this;
    }

}
