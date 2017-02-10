<?php

namespace App\Exceptions;

/**
 * NotFoundException
 *
 * @category  Exceptions
 * @package   Exceptions
 * @author    Jesus Farfan <jesus.farfan@nidarbox.com>
 * @copyright Jesus Farfan
 * @license   MIT 
 * @link      https://nidarbox.com
 */
class NotFoundException extends \Exception
{
    
    /**
     * __construct
     * 
     * @param string $message Message error
     * @param int    $code    Code error
     *
     * @return void
     */
    public function __construct(string $message, int $code = 500)
    {
        parent::__contruct('NotFoundException : ' . $message, $code);
    }
}
