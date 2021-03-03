<?php

namespace Bachtiar\Helper\Response\Service;

/**
 * Response Service
 * 
 * :: how to use
 * => ResponseService::setStatus(true)->setData([])->setDataAdd([])->setMessage('default')->response();
 *
 * :: setStatus(true)
 *
 * :: setData([])
 * 
 * :: setDataAdd([])
 *
 * :: setMessage('default')
 * 
 * :: response()
 */
class ResponseService
{
    protected static $status;
    protected static $data;
    protected static $dataAdd;
    protected static $message;

    // ? Public Methods
    /**
     * Get response result
     *
     * @return array
     */
    public static function response(): array
    {
        return self::createResponseResult();
    }

    // ? Private Methods
    /**
     * Process of creating response result
     *
     * @return array
     */
    private static function createResponseResult(): array
    {
        return [
            'status' => static::$status,
            'data' => static::$data,
            'data_add' => static::$dataAdd,
            'message' => static::$message
        ];
    }

    // ? Setter Module
    /**
     * Set value status response.
     * 
     * -> status of response, available [ true, false ],
     * if null then auto set to true.
     *
     * @param boolean $status
     * @return self
     */
    public static function setStatus(bool $status = true): self
    {
        self::$status = $status;

        return new self;
    }

    /**
     * Set value of data.
     * 
     * -> set data response value, ! must be an array,
     * if null then will be set to an empty array.
     *
     * @param array $data
     * @return self
     */
    public static function setData(array $data = []): self
    {
        self::$data = $data;

        return new self;
    }

    /**
     * Set value of additional data.
     * 
     * -> set config data from response result, ! must be an array,
     * if null then will be set to an empty array.
     *
     * @param array $dataAdd
     * @return self
     */
    public static function setDataAdd(array $dataAdd = []): self
    {
        self::$dataAdd = $dataAdd;

        return new self;
    }

    /**
     * Set message of response.
     * 
     * -> set message from response result,
     * if null then will be no any response message.
     *
     * @param string $message
     * @return self
     */
    public static function setMessage(string $message = ''): self
    {
        self::$message = $message;

        return new self;
    }
}
