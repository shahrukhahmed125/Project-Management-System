<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AjaxForm extends Component
{
    public $formId;
    public $btnId;
    public $removeImageId;


    /**
     * Create a new component instance.
     */
    public function __construct($formId = 'user-form', $btnId = 'user-form-btn', $removeImageId = 'removeImage1')
    {
        $this->formId = $formId;
        $this->btnId = $btnId;
        $this->removeImageId = $removeImageId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ajax-form');
    }
}
