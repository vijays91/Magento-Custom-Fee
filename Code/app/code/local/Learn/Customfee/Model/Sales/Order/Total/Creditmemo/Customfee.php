<?php
class Learn_Customfee_Model_Sales_Order_Total_Creditmemo_Customfee extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    /*
    
        Sales Order Edit Page, Creditmemo the Order
    
    */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        if(Mage::helper('customfee')->canApply()) {
            $amount = $this->getFeeAmount($creditmemo->getSubtotal());
            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $amount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $amount);
        }
        return $this;
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