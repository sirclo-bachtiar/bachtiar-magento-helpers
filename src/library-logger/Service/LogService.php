<?php

namespace Bachtiar\Helper\Logger\Service;

use Laminas\Log\Writer\Stream;
use Laminas\Log\Logger;

/**
 * Logging Activity Service
 *
 * :: how to use
 * => LogService::setChannel('default')->setMode('default')->setMessage('message_to_log')->log();
 *
 * :: setChannel('default')
 *
 * :: setMode('default')
 *
 * :: setMessage('default')
 * 
 * :: log()
 */
class LogService
{
    protected static $channel;
    protected static $mode;
    protected static $message;

    /**
     * Change the value of BASE_DIR on line 34,
     * adjust to the location where your logs are stored.
     * you can use [ define() ] at [ autoload ] file,
     * default [ dirname(__DIR__) ].
     */
    private const BASE_DIR = BP;
    private const LOCATION = '/var/log/';
    private const IDENTITY = 'bachtiar.';
    private const FILEFORMAT = '.log';

    /**
     * Logger Priority.
     * source -> https://docs.laminas.dev/laminas-log/intro/#using-built-in-priorities
     */
    private const CHANNEL_EMERGENCY = 0;
    private const CHANNEL_ALERT = 1;
    private const CHANNEL_CRITICAL = 2;
    private const CHANNEL_ERROR = 3;
    private const CHANNEL_WARNING = 4;
    private const CHANNEL_NOTICE = 5;
    private const CHANNEL_INFO = 6;
    private const CHANNEL_DEBUG = 7;

    private const FILE_DEFAULT = 'default';
    private const FILE_TEST = 'test';
    private const FILE_DEBUG = 'debug';
    private const FILE_DEVELOP = 'develop';

    private const DEFAULT_MESSAGE = 'log test successfully';

    // ? Public Methods
    /**
     * create log process
     *
     * @return void
     */
    public static function log(): void
    {
        self::createNewLog();
    }

    // ? Private Methods
    /**
     * process for creating log
     *
     * @return void
     */
    private static function createNewLog(): void
    {
        $writer = new Stream(static::BASE_DIR . self::fileNameResolver());

        $logger = new Logger;

        $logger->addWriter($writer)->log(self::channelResolver(), self::messageResolver());
    }

    /**
     * resolve channel selected
     *
     * @return integer
     */
    private static function channelResolver(): int
    {
        $getChannel = static::$channel ?? 'debug';

        $channelAvailable = [
            'emerg' => static::CHANNEL_EMERGENCY,
            'alert' => static::CHANNEL_ALERT,
            'crit' => static::CHANNEL_CRITICAL,
            'err' => static::CHANNEL_ERROR,
            'warn' => static::CHANNEL_WARNING,
            'notice' => static::CHANNEL_NOTICE,
            'info' => static::CHANNEL_INFO,
            'debug' => static::CHANNEL_DEBUG
        ];

        try {
            return $channelAvailable[$getChannel];
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return $channelAvailable['debug'];
        }
    }

    /**
     * resolve message input
     *
     * @return string
     */
    private static function messageResolver(): string
    {
        return static::$message;
    }

    /**
     * resolve saving log location
     *
     * @return string
     */
    private static function fileNameResolver(): string
    {
        $getMode = static::$mode ?? 'default';

        $modeAvailable = [
            'test' => static::FILE_TEST,
            'debug' => static::FILE_DEBUG,
            'develop' => static::FILE_DEVELOP,
            'default' => static::FILE_DEFAULT
        ];

        try {
            $modeResult = $modeAvailable[$getMode];
        } catch (\Throwable $th) {
            echo $th->getMessage();
            $modeResult = $modeAvailable['default'];
        }

        return (string) static::LOCATION . static::IDENTITY . $modeResult . static::FILEFORMAT;
    }

    // ? Setter Module
    /**
     * Set value of channel.
     * 
     * -> select channel, available [ emerg, alert, crit, err, warn, notice, info ],
     * if null then auto set to default.
     *
     * @param string $channel
     * @return self
     */
    public static function setChannel(string $channel = 'debug'): self
    {
        self::$channel = $channel;

        return new self;
    }

    /**
     * Set value of mode.
     * 
     * -> select log mode, available [ test, debug, develop ],
     * if null then auto set to default.
     *
     * @param string $mode
     * @return self
     */
    public static function setMode(string $mode = 'default'): self
    {
        self::$mode = $mode;

        return new self;
    }

    /**
     * Set value of message
     * 
     * -> set log message,
     * if null then auto set to default message.
     *
     * @param string $message
     * @return self
     */
    public static function setMessage(string $message = self::DEFAULT_MESSAGE): self
    {
        self::$message = $message;

        return new self;
    }
}
