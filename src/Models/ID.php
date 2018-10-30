<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 30.10.18
 * Time: 13:01
 */

namespace KielD01\RandomUser\Models;


use stdClass;

/**
 * Class ID
 * @package KielD01\RandomUser\Models
 * @property string name
 * @property string value
 */
class ID
{
    public function __construct(stdClass $id = null)
    {
        $this->name = $id->name;
        $this->value = $id->value;
    }
}
