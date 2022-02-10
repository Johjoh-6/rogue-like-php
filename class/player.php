<?php

class Player{
    public $pos = [];
    protected $symbol;
    protected $pocket;
    function __construct($symbol)
    {
        $this->symbol = $symbol;
    }
    public function getSymbol(){
        return $this->symbol;
    }
    public function getPlayerPos(){
        return $this->pos;
    }
    public function lookPokect(){
        return $this->pocket;
    }
    public function setPlayerPos($newPos){
        return $this->pos = $newPos;
    }
    public function setSymbol($choixSymbol){
        return $this->symbol = $choixSymbol;
    }
    public function setPocket($new){
        return $this->pocket = $new;
    }
}