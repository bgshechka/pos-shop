<?php
class ProductInCart extends Products implements IECartPosition
{
	public $name;
	public $article;
	public $attributes;
	public $count;
	public $prices;
	public $intervals;
	public $priceForThisCount;
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

	function calculatePriceForThisCount()
	{
        for ($i=0;$i<count($this->intervals);$i++)
        {
            if ($this->count<=$this->intervals[$i] || $this->intervals[$i]==-1)
            {
                $this->priceForThisCount = $this->count*$this->prices[$i];
                break;
            }
        }
        
	}

	function getId(){

        return $this->id;
    }

    function getPrice(){
        return $this->price;
    }

	
}