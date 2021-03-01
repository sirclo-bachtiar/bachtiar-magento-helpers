<?php

namespace Bachtiar\Helper\Zend\Magento\Logger\Test;

use Bachtiar\Helper\Zend\Magento\Logger\Service\LogService;

class LogTester
{
    public function __invoke()
    {
        return LogService::setChannel('alert')->setMode('debug')->setMessage('debug message test')->log();
    }
}
