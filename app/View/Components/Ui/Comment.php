<?php

namespace App\View\Components\Ui;

use App\Models\Comment as ModelsComment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Comment extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $replying = true;

    public function __construct($id, $replying = true)
    {
        $this->id = $id;
        $this->replying = $replying;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $comment = ModelsComment::findOrFail($this->id);
        return view('components.ui.comment', ['comment' => $comment]);
    }
}
