<?php

namespace App\View\Components\Ui;

use App\Models\Posts;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $id
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $post = Posts::findOrFail($this->id);
        return view('components.ui.post-card', ['post' => $post]);
    }
}
