<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileUpload extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $type;
    public $placeholder;
    public $name;
    public $value;

    public function __construct($type, $placeholder, $name, $value = null)
    {
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file-upload');
    }
}
