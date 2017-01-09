<?php

/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 01/01/2017
 * Time: 01:15
 */
class sliderBar
{
    public $current, $previous, $name;

    function __construct($input){
        $this->current=$input['current'];
        $this->previous = $input['previous'];
        $this->name = $input['name'];
    }

    function displaySlider(){
        if($this->previous<$this->current){
            $orangeWidth = $this->previous;
            $greenWidth = $this->current-$this->previous;
            $redWidth = 0;
            $amountColor = "#22f36f";
            $amtChange = 5*$greenWidth/100;
            $description = $this->name." (+ $amtChange)";
        } else {
            $orangeWidth = $this->current;
            $greenWidth = 0;
            $redWidth = $this->previous-$this->current;
            $amountColor = "#ff0000";
            $amtChange = round(5*$redWidth/100,2);
            $description = $this->name." (- $amtChange)";
        }
        $currentResult = round(5*$this->current/100,2);

        echo ("
            <div class='slider-wrapper'>
                <span class='slider-description''>$description</span>
                <span class='slider-change-amount' style='color: $amountColor'>$currentResult</span>
               
                <div class = 'slider-bar'>
                    <div class='slider-orange' style='width: $orangeWidth%'></div>
                    <div class='slider-green' style='width: $greenWidth%'></div>
                    <div class='slider-after'></div>    
                    <div class='slider-red' style='width: $redWidth%'></div>
            
                </div>
            </div>
        
        ");
    }
}