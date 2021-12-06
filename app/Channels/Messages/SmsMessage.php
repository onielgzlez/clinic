<?php

namespace App\Channels\Messages;

class SmsMessage
{
    public $content;

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }
}
