<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.10.18
 * Time: 21:16
 */

namespace KielD01\RandomUser\Helpers;

use Carbon\Carbon;
use KielD01\RandomUser\Models\ID;
use KielD01\RandomUser\Models\Location;
use KielD01\RandomUser\Models\Login;
use KielD01\RandomUser\Models\Name;
use KielD01\RandomUser\Models\Picture;
use stdClass;

/**
 * Class Entity
 * @package KielD01\RandomUser\Models
 * @property ID id
 * @property Name name
 * @property Login login
 * @property Picture picture
 * @property Location location
 *
 * @property string gender
 * @property string email
 * @property Carbon dob
 * @property Carbon registered
 * @property string phone
 * @property string cell
 * @property string nat
 *
 */
class Entity
{
    public function __construct(stdClass $data = null)
    {
        $this->id = new ID($data->id);
        $this->name = new Name($data->name);
        $this->login = new Login($data->login);
        $this->picture = new Picture($data->picture);
        $this->location = new Location($data->location);

        $this->dob = Carbon::createFromTimeString($data->dob);
        $this->registered = Carbon::createFromTimeString($data->registered);

        array_map(function ($field) use ($data) {
            $this->{$field} = $data->{$field};
        }, ['gender', 'email', 'phone', 'cell', 'nat']);

    }
}
