<?php
class Learn_Customfee_Block_Sales_Order_Totals extends Mage_Sales_Block_Order_Totals 
{

    /*
    
        Email Order Email.
        Front-end My Order View Page.
    
    */
    
    protected function _initTotals() {
        parent::_initTotals();
        if(Mage::helper('customfee')->canApply()) {
            $subtotal = $this->getSource()->getSubtotal();
            $amount = $this->getFeeAmount($subtotal);
            $this->addTotalBefore(new Varien_Object(array(
                'code'      => 'customfee',
                'value'     => $amount,
                'base_value'=> $amount,
                'label'     => $this->getLabel(),
            ), array('shipping', 'tax')));
        }  
        return $this;
    }
    
    public function getLabel() {
         return Mage::helper('customfee')->customLabel();
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