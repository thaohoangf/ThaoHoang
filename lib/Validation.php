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
                        'email' => array('email'));

    public $checkValue = array('name','password','email');

    public function checkValue($data = array())
    {
        foreach($data as $key => $value){
            if(in_array($key,$this->checkValue)){
                foreach($this->rule as $type => $law){
                    if($key == $type){
                       foreach($law as $rule){
                           if($this->$rule($value,$key)){
                               $notice = $this->$rule($value,$key);
                               $this->error[] = ([$key => $notice]);
                               break;
//                           }else {
//                               $this->error[] = ([$key => '']);
//                               break;
                           }
                       }
                   }
                }
            }
        }
//        var_dump($this->error);
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
}