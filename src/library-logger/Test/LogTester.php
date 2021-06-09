<?php

namespace Bachtiar\Helper\Logger\Test;

use Bachtiar\Helper\Logger\Service\LogService;

class LogTest
{
    public function __invoke()
    {
        return LogService::channel('default')->mode('default')->title('log_title')->message('message_to_log');
    }
}
