<?php
class ProductInCart extends Products implements IECartPosition
{
	public $name;
	public $attributes;
	public $count;
	public $priceForOne;
	public $discount;
	public $productId;

 	
 	/*
	public function __construct($_name,$_attr,$_count,$_priceFO)
	{
		$name = $_name;
		$attributes = $_attr;
		$count = $_count;
		$priceForOne = $_priceFO;
	}
	*/

	public function getSumPrice()
	{
		$ret = $priceForOne*$count;
		return $ret;
	}

	function getId(){

        return $this->id;
    }

    function getPrice(){
        return $this->price;
    }

	
}