<?php

class Sendpulse_Integration_Block_Adminhtml_System_Config_Form_Registration extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('sendpulseintegration/system/config/registration.phtml');
    }

    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     *
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }

    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getRegistrationUrl()
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/adminhtml_integration/registration');
    }

    /**
     * Generate button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(
                array(
                    'id'      => 'sendpulseintegration_button',
                    'label'   => $this->helper('adminhtml')->__('Регистрация'),
                    'onclick' => 'javascript:connect(); return false;'
                )
            );

        return $button->toHtml();
    }
}