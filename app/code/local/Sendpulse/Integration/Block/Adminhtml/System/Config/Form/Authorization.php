<?php

class Sendpulse_Integration_Block_Adminhtml_System_Config_Form_Authorization extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('sendpulseintegration/system/config/authorization.phtml');
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
//
//    /**
//     * Return ajax url for button
//     *
//     * @return string
//     */
//    public function getConnectUrl()
//    {
//        return Mage::helper('adminhtml')->getUrl('adminhtml/adminhtml_integration/connect');
//    }

    public function getAuthorizationUrl()
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/adminhtml_integration/authorization');
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
                    'label'   => $this->helper('adminhtml')->__('Подключить'),
                    'onclick' => 'javascript:signin(); return false;'
                )
            );

        return $button->toHtml();
    }
}