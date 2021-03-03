# Bachtiar Service Helpers

#### Service Helpers.
This service is used to help some activities during your work, which contains several functions that may make your job simpler.
Personally, this library is used for magento.

## Installation

```bash
composer require sirclo-bachtiar/bachtiar-magento-helpers
```

## Usage
- ### Logger Service
It's used for saving log activity.
```bash
use Bachtiar\Helper\Logger\Service\LogService;

class LogTester
{
    public function Log()
    {
        return LogService::setChannel('alert')->setMode('debug')->setMessage('message debug alert')->log();
    }
}

#### Info ####
:: setChannel('default')
    -> select channel, available [ emerg, alert, crit, err, warn, notice, info ], if null then auto set to default.

:: setMode('default')
    -> select log mode, available [ test, debug, develop ], if null then auto set to default.

:: setMessage('default')
    -> set log message, if null then auto set to default message.

:: log()
    -> process to create log.

```

- ### Response Service
It's used for create a response result from your functions/methods activity.
```bash
use Bachtiar\Helper\Response\Service\ResponseService;

class ResponseTest
{
    public function Response()
    {
        return ResponseService::setStatus(true)->setData([])->setDataAdd([])->setMessage('default')->response();
    }
}

#### Info ####
:: setStatus(true)
    -> status of response, available [ true, false ], if null then auto set to true.

:: setData([])
    -> set data response value, ! must be an array, if null then will be set to an empty array.

:: setDataAdd([])
    -> set config data from response result, ! must be an array, if null then will be set to an empty array.

:: setMessage('default')
    -> set message from response result, if null then will be no any response message.

:: response()
    -> process to create response.

```

