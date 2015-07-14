<?php

class searchForm extends CFormModel
{
    public $name;
    public $chod;
   
	
	public function attributeLabels()
    {
        return array('chod_label' => 'ЧОД',
					 'name_label' => 'Название',
					 				 
		);
    } 
	
    public function rules()
	{
		return array(
			// username and password are required
			//array('login,password,email,name,phone,info', 'required'),
			array('name,chod','safe')
		);
	}
    
    
    
}