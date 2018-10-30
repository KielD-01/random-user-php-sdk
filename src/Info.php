<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.10.18
 * Time: 20:38
 */

namespace KielD01\RandomUser;

use stdClass;

/**
 * Class Info
 * @package KielD01\RandomUser
 * @property string seed
 * @property integer results
 * @property integer page
 * @property float v
 */
class Info
{
    public function __construct(stdClass $info)
    {
        $this->seed = $info->seed;
        $this->results = $info->results;
        $this->page = $info->page;
        $this->v = $info->version;
    }
}
