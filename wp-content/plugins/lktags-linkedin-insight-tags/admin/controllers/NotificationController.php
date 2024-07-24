<?php
namespace Pagup\Lktags\Controllers;

use \Pagup\Lktags\Core\Plugin;

class NotificationController
{
    public function support() 
    {

        $text_domain = Plugin::domain();

        return Plugin::view('notices/support', compact('text_domain'));

    }
}