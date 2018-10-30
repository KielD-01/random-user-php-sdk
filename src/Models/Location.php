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
 * Class Location
 * @package KielD01\RandomUser\Models
 * @property string street
 * @property string city
 * @property string state
 * @property integer postcode
 */
class Location
{
    public function __construct(stdClass $location = null)
    {
        $this->street = $location->street;
        $this->city = $location->city;
        $this->state = $location->state;
        $this->postcode = $location->postcode;
    }

}
