<?php

namespace Black\Page\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class WebPageNotFoundException
 */
final class WebPageNotFoundException extends NotFoundHttpException
{
    /**
     * Constructor.
     *
     * @param string     $message  The internal exception message
     * @param \Exception $previous The previous exception
     * @param integer    $code     The internal exception code
     */
    public function __construct($message = 'WebPage Not Found!', \Exception $previous = null, $code = 0)
    {
        parent::__construct($message, $previous, $code);
    }
}
