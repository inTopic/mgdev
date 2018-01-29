<?php
/**
 * Used in creating options config value selection
 *
 */
class Sendpulse_Integration_Model_Adminhtml_System_Config_Form_Customers
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => '', 'label'=>Mage::helper('sendpulseintegration')->__('123@gmail.com')),
            array('value' => 1,  'label'=>Mage::helper('sendpulseintegration')->__('Arnold')),
            array('value' => 2,  'label'=>Mage::helper('sendpulseintegration')->__('Mark')),
            array('value' => 3,  'label'=>Mage::helper('sendpulseintegration')->__('Quentin')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            '' => Mage::helper('sendpulseintegration')->__('John'),
            1  => Mage::helper('sendpulseintegration')->__('Arnold'),
            2  => Mage::helper('sendpulseintegration')->__('Mark'),
            3  => Mage::helper('sendpulseintegration')->__('Quentin'),
        );
    }
}