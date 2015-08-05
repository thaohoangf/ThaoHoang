<?php

/**
 * Created by PhpStorm.
 * User: Thao
 * Date: 8/4/2015
 * Time: 13:47
 */
class Validation
{
    public $error = array();
    public $rule = array('name' => array('required','min','max','name'),
                        'password' => array('required','min','max','password'),
                        'email' => array('email'),
                        'price' => array('price'),);

//    public $checkValue = array('name','password','email');

    public function checkValue()
    {
       foreach($this->rule as $key => $value){
               foreach($value as $law) {
                   if(isset($_REQUEST[$key])){
                   if ($this->$law($_REQUEST[$key], $key)) {
                       $notice = $this->$law($_REQUEST[$key], $key);
                       $this->error[$key] = $notice;
                       break;
                   }
               }
           }
       }
        return $this->error;
    }

    public function password($value,$key)
    {
        $pattern = '/^[a-zA-Z0-9]+$/';
        $message = '';
        if(!preg_match($pattern,$value)){
            $message = 'Wrong character of '.$key;
        }
        return $message;
    }

    public function required($value,$key)
    {
        $message = '';
        if(empty($value)){
            $message = 'Do not blank '.$key;
        }
        return $message;
    }

    public function name($value,$key)
    {
        $pattern = '/^[a-zA-Z0-9]+$/';
        $message = '';
        if(!preg_match($pattern,$value)){
            $message = 'Wrong character of '.$key;
        }
        return $message;
    }

    public function min($value,$key)
    {
        $message = '';
        $pattern = '/^[a-zA-Z0-9]{8,}$/';
        if(!preg_match($pattern,$value)){
            $message = $key . ' must be at least 8 characters';
        }
        return $message;
    }

    public function max($value,$key)
    {
        $message = '';
        $pattern = '/^[a-zA-Z0-9]{8,32}$/';
        if(!preg_match($pattern,$value)){
            $message = $key . ' must be at most 32 characters';
        }
        return $message;
    }

    public function email($value,$key)
    {
        $message = '';
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
            $message = 'Invalid form '.$key;
        }
        return $message;
    }

    public function price($value, $key)
    {
        $message = '';
        if(!is_numeric($value)){
            $message = 'Value of '. $key . 'must be number';
        }
        return $message;
    }
}
