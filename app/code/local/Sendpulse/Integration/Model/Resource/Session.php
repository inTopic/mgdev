<?php

/**
 * Class Speroteck_Popup_Model_Resource_Popup
 */
class Speroteck_Popup_Model_Resource_Popup extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('speroteck_popup/popup', 'popup_id');
    }
}