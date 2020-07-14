<?php


namespace App\Http\Entities;


abstract class AbstractEntity
{
    /**
     * @param array $data
     */
    public function __construct($data = null)
    {
        if($data) {

            foreach ($data as $nameProperty => $valueProperty){

                if (property_exists($this, $nameProperty))
                    $this->$nameProperty = $valueProperty;
            }
        }
    }
}
