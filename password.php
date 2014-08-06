<?php

class password {

    private $lowercase = "abcdefghijklmnopqrstuvwxyz";
    private $uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    private $number = "1234567890";
    private $symbol = '~!@#%&*()_-+={}[]\|:;<>,.?/\'^';
    private $msgError = false;
    private $msgSuccess = false;
    private $option; 

    public function __construct() {
        
    }

    public function setOption($option) {
        $this->option["lowercase"] = $option["lowercase"];
        $this->option["uppercase"] = $option["uppercase"];
        $this->option["number"] = $option["number"];
        $this->option["symbol"] = $option["symbol"];
        $this->option["size"] =  $option["size"];
    }

    public function getMix() {

        $char = '';
        
        if ($this->option["lowercase"] == false && $this->option["uppercase"] == false && $this->option["number"] == false && $this->option["symbol"] == false) {
            $this->msgError = "You must  choose at least 1 filter";
        }

        if ($this->option["lowercase"])
            $char .= $this->lowercase;
        if ($this->option["uppercase"])
            $char .= $this->uppercase;
        if ($this->option["number"])
            $char .= $this->number;
        if ($this->option["symbol"])
            $char .= $this->symbol;
        $result = substr(str_shuffle($char), 0, $this->option["size"]);
        return $result;
    }

}
