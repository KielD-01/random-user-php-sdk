<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.10.18
 * Time: 20:35
 */

namespace KielD01\RandomUser\Models;

use stdClass;

/**
 * Class Name
 * @package KielD01\RandomUser\Models
 * @property string title
 * @property string first
 * @property string last
 */
class Name
{
    public function __construct(stdClass $name)
    {
        $this->first = $name->first;
        $this->last = $name->last;
        $this->title = $name->title;
    }
}
