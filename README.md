# Bachtiar Service Helpers

## Service Helpers.
This service is used to help some activities during your work, which contains several functions that may make your job simpler.
Personally, this library is used for magento.

## Require
This library requiring **[Laminas Log](https://github.com/laminas/laminas-log)** for create logger.
## Installation

```bash
composer require sirclo-bachtiar/magento-helpers
```

## Usage
- ### Logger Service
It's used for saving log activity.
```bash
use Bachtiar\Helper\Logger\Service\LogService;

class LogTest
{
    public function Log()
    {
        return LogService::channel('default')
            ->mode('default')
            ->title('log_title')
            ->message('message_to_log');
    }
}

#### Info ####
:: channel('default')
    -> select channel, available [ emerg, alert, crit, err, warn, notice, info ], if null then auto set to default.

:: mode('default')
    -> select log mode, available [ test, debug, develop ], if null then auto set to default.

:: title('default')
    -> set log title, if null then auto set to default title.

:: message('default')
    -> set log message, if null then auto set to default message.

```

- ### Response Service
It's used for create a response result from your functions/methods activity.
```bash
use Bachtiar\Helper\Response\Service\ResponseService;

class ResponseTest
{
    public function Response()
    {
        return ResponseService::setStatus(true)
            ->setData([])
            ->setDataAdd([])
            ->setMessage('default')
            ->response();
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

- ### Query Builder Service
It's used for custom query builder. (return query only).
```bash
use Bachtiar\Helper\DB\Query\Service\QueryBuilderService;

class QueryBuilderTest
{
    public function QueryBuilder()
    {
        return QueryBuilderService::select([])->from('base_table')
            ->join('relation_table', 'baseColumnId', '=', 'relationColumnId')
            ->where('base_table.name', '=', 'test')
            ->andWhere('base_table.age', '=', 'age')
            ->orWhere('relation_table.address', 'like', '%ponorogo%')
            ->get();
    }
}

#### Info ####
:: select([]) -> optional
    -> set select column, if null, then auto set to all (*).

:: from('base_table') -> ! must be included
    -> set base table query.

:: join('relation_table', 'baseColumnId', '=', 'relationColumnId')
    -> set inner join from query.

:: where('base_table.name', '=', 'test') -> optional
    -> set where clause from query

:: andWhere('base_table.age', '=', 'age') -> optional
    -> set or where clause from query

:: orWhere('relation_table.address', 'like', '%ponorogo%') -> optional
    -> set and where clause from query

:: get()
    -> process to create query builder.
```
