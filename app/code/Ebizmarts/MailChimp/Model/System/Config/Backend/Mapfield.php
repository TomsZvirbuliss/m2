<?php

namespace code\Ebizmarts\MailChimp\Model\System\Config\Backend-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\System\Config\Backend;
use code\Ebizmarts\MailChimp\Helper\Ebizmarts_MailChimp_Helper_Data;use Ebizmarts_Mailchimp4Magento\Exception;use Ebizmarts_Mailchimp4Magentouse;use Mage;use Mage_Adminhtml_Model_System_Config_Backend_Serialized_Array; Ebizmarts_MailChimp_Helper_Data;
/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     8/4/16 5:56 PM
 * @file:     Apikey.php
 */
class Ebizmarts_MailChimp_Model_System_Config_Backend_Mapfield
    extends Mage_Adminhtml_Model_System_Config_Backend_Serialized_Array
{
    /**
     * @var Ebizmarts_MailChimp_Helper_Data
     */
    protected $_helper;

    protected function _afterLoad()
    {
        $this->_helper = Mage::helper('mailchimp');

        if (!is_array($this->getValue())) {
            if (is_object($this->getValue())) {
                $serializedValue = $this->getValue()->asArray();
            } else {
                $serializedValue = $this->getValue();
            }

            $unserializedValue = false;

            if (!empty($serializedValue)) {
                try {
                    $unserializedValue = $this->_helper->unserialize($serializedValue);
                } catch (Exception $e) {
                    Mage::logException($e);
                }
            }

            $this->setValue($unserializedValue);
        }
    }
}
