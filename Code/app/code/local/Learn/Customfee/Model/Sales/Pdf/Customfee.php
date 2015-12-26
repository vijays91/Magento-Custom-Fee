<?php
class Learn_Customfee_Model_Sales_Pdf_Customfee extends Mage_Sales_Model_Order_Pdf_Total_Default
{
    /*
    
        PDF print the Invoice/creditmemo
    
    */
    public function getTotalsForDisplay()
    {
        $store = $this->getOrder()->getStore();
        $subtotal = $this->getOrder()->getSubtotal();        
        $customFee = $this->getFeeAmount($subtotal);        
        $fontSize = $this->getFontSize() ? $this->getFontSize() : 7;
        
        $amount = $this->getOrder()->formatPriceTxt($customFee);
        
        $totals = array(array(
            'amount'    => $this->getAmountPrefix().$amount,
            'label'     => $this->getLabel(). ':',
            'font_size' => $fontSize
        ));
        return $totals;
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