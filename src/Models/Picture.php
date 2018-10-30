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
 * Class Picture
 * @package KielD01\RandomUser\Models
 * @property string large
 * @property string medium
 * @property string thumbnail
 */
class Picture
{
    public function __construct(stdClass $picture = null)
    {
        $this->large = $picture->large;
        $this->medium = $picture->medium;
        $this->thumbnail = $picture->thumbnail;
    }

}
