<?php


namespace App\Repositories;

use Exception;
use Throwable;

abstract class BaseException extends Exception
{
    /**
     * @var array
     */
    private $response;

    /**
     * BaseException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message,int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->response = [
            'errors' => [
                "code"=> $this->getCode(),
                "message"=> $this->getMessage(),
            ],
        ];
    }

    /**
     * @return array|array[]
     */
    final public function getResponse(): array
    {
        return $this->response;
    }
}
