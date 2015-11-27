<?php
/**
 * Exception for user already exist
 *
 * @package Ibonly\PotatoORM\DataAlreadyExistException
 * @author  Ibraheem ADENIYI <ibonly01@gmail.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 */

namespace Ibonly\PotatoORM;

use Exception;

class DataAlreadyExistException extends Exception
{
    public function __construct()
    {
        parent::__construct("Data already exist in database");
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function errorMessage()
    {
        return "Error: " . $this->getMessage();
    }
}