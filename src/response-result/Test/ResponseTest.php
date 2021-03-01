<?php

namespace Bachtiar\Helper\Response\Test;

use Bachtiar\Helper\Response\Service\ResponseService;

class ResponseTest
{
    public function __invoke()
    {
        return ResponseService::setStatus(true)->setData([])->setDataAdd([])->setMessage('default')->response();
    }
}
