<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.10.18
 * Time: 20:53
 */

namespace KielD01\RandomUser\Helpers;

/**
 * Class Collection
 * @package KielD01\RandomUser\Models
 * @property Entity[] items
 */
class Collection
{
    public function __construct(array $results = [])
    {
        foreach ($results as $result) {
            $this->items[] = new Entity($result);
        }
    }
}
