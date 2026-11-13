<?php 
namespace App\Libraries;

class Hash
{
    public static function make($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function hashing($password){
        $md5 = md5('admin');
        return sha1(md5(hash('sha512', $password.$md5)));
    }
    
}