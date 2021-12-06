<?php

namespace App\Channels\Messages;

class EmailMessage
{
    public $content;

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }
}
