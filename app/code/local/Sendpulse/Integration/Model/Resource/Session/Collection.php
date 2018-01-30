<?php

/**
 * Class Speroteck_Popup_Model_Resource_Popup_Collection
 */
class Speroteck_Popup_Model_Resource_Popup_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * constuct
     */
    public function _construct()
    {
        $this->_init('speroteck_popup/popup');
    }
}
