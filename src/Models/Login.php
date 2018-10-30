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
 * Class Login
 * @package KielD01\RandomUser\Models
 * @property string username
 * @property string password
 * @property string salt
 * @property string md5
 * @property string sha1
 * @property string sha256
 */
class Login
{
    public function __construct(stdClass $login = null)
    {
        $this->username = $login->username;
        $this->password = $login->password;
        $this->salt = $login->salt;
        $this->md5 = $login->md5;
        $this->sha1 = $login->sha1;
        $this->sha256 = $login->sha256;
    }

}
