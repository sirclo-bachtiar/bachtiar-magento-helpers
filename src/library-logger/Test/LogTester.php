<?php

namespace Bachtiar\Helper\Logger\Test;

use Bachtiar\Helper\Logger\Service\LogService;

class LogTest
{
    public function __invoke()
    {
        return LogService::setChannel('alert')->setMode('debug')->setMessage('message debug alert')->log();
    }
}
