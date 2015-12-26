<?php
class Learn_Customfee_Model_Sales_Order_Total_Invoice_Customfee extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    /*
    
        Sales Order Edit Page, Invoice the Order
    
    */

    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        if(Mage::helper('customfee')->canApply()) {
            $amount = $this->getFeeAmount($invoice->getSubtotal());            
            $invoice->setGrandTotal($invoice->getGrandTotal() + $amount);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $amount);
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