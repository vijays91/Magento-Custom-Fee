<?php
class Learn_Customfee_Model_Sales_Quote_Address_Total_Customfee extends Mage_Sales_Model_Quote_Address_Total_Abstract 
{
    /*
        
        Front-end Checkout, Cart Page
        Sales order edit page admin Grid.        
    
    */

    protected $_code = 'customfee';

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);
        if (($address->getAddressType() == 'billing')) {
            return $this;
        }
        
        if (Mage::helper('customfee')->canApply()) {
            $amount = $this->getFeeAmount($address->getSubtotal());
            $this->_addAmount($amount);
            $this->_addBaseAmount($amount);
        }
         return $this;
    }
    
    public function fetch(Mage_Sales_Model_Quote_Address $address) {
    
        if (($address->getAddressType() == 'billing')) {
            return $this;
        }
        if(Mage::helper('customfee')->canApply()) {
            $amount = $this->getFeeAmount($address->getSubtotal());
            $address->addTotal(array(
                'code'  => $this->getCode(),
                'title' => $this->getLabel(),
                'value' => $amount
            ));
        }
        
        return $this;
    }
    
    public function getLabel() {
         return Mage :: helper('customfee')->customLabel();
    }
    
    public function getFeeAmount($totalAmount) {  
        $amount = Mage::helper('customfee')->customAmount();
        $amount = (float)$amount;
        $type = Mage::helper('customfee')->customfeeType();
        if($type == "fixed") {
            $amt = $amount;
        } else {
            $amt = (($totalAmount) * ($amount/100));
        }
        $amt = number_format($amt, 2, '.', '');
        return $amt;
    }
}