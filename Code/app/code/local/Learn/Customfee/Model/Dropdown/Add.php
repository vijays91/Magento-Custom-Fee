<?php
class Learn_Customfee_Model_Dropdown_Add extends Mage_Core_Model_Abstract
{
	public function toOptionArray()
	{
		return array(
			array(
				'value' => '+',
				'label' => 'Addision',
			),
			array(
				'value' => '-',
				'label' => 'Subtraction',
			),
		);
	}
}