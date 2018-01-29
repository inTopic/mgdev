<?php

/**
 * Class Sendpulse_Integration_Block_Adminhtml_System_Config_Form_Export
 */
class Sendpulse_Integration_Block_Adminhtml_System_Config_Form_Export
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * _construct
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('sendpulseintegration/system/config/export.phtml');
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
    public function getExportUrl()
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/adminhtml_integration/export');
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
                    'id'      => 'sendpulseintegration_export_button',
                    'label'   => $this->helper('adminhtml')->__('Подключить'),
                    'onclick' => 'javascript:exportCustomers(); return false;'
                )
            );

        return $button->toHtml();
    }
}