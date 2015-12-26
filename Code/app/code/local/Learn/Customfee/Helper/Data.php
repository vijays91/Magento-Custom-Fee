<?php
class Learn_Customfee_Helper_Data extends Mage_Core_Helper_Abstract {

    const XML_PATH_FEE_ENABLE    = 'customfee_tab/customfee_setting/customfee_active';
    const XML_PATH_FEE_TITLE   	 = 'customfee_tab/customfee_setting/customfee_title';
    const XML_PATH_FEE_AMOUNT    = 'customfee_tab/customfee_setting/customfee_amount';
    const XML_PATH_FEE_TYPE      = 'customfee_tab/customfee_setting/customfee_amount_type';
    const XML_PATH_FEE_ADD_MINUS = 'customfee_tab/customfee_setting/customfee_amount_add';
    
	
	public function conf($code, $store = null) {
        return Mage::getStoreConfig($code, $store);
    }
	
	public function canApply($store) {
		return $this->conf(self::XML_PATH_FEE_ENABLE, $store);
	}
    
    public function customAmount($store) {
        $amount = $this->conf(self::XML_PATH_FEE_AMOUNT, $store);
        $sign = $this->conf(self::XML_PATH_FEE_ADD_MINUS, $store);
        return (string)$sign.$amount;
    }
    
    public function customfeeType($store) {
        return $this->conf(self::XML_PATH_FEE_TYPE, $store);
    }
    
    public function customLabel(){
        return $this->conf(self::XML_PATH_FEE_TITLE, $store);    
    }
	
}