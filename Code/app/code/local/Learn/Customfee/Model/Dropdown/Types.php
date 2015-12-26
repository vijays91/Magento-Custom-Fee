<?php
class Learn_Customfee_Model_Dropdown_Types extends Mage_Core_Model_Abstract
{
	public function toOptionArray()
	{
		return array(
			array(
				'value' => 'fixed',
				'label' => 'Fixed',
			),
			array(
				'value' => 'percentage',
				'label' => 'Percentage',
			),
		);
	}
}