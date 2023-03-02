<?php

namespace code\Ebizmarts\MailChimp\Block\Adminhtml\System\Config-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Block\Adminhtml\System\Config;
use code\Ebizmarts\MailChimp\Helper\Ebizmarts_MailChimp_Helper_Data;use Ebizmarts_Mailchimp4Magentouseuse;use Ebizmarts_MailChimp_Model_System_Config_Source_Account;use Mage;use Mage_Adminhtml_Block_System_Config_Form_Field;use Varien_Data_Form_Element_Abstract; Ebizmarts_MailChimp_Helper_Data; Ebizmarts_Mailchimp4Magentouse Ebizmarts_Mailchimp4Magentouse Ebizmarts_Mailchimp4Magento
/**
 * MailChimp For Magento
 *
 * @category  Ebizmarts_MailChimp
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     4/29/16 3:55 PM
 * @file:     Account.php
 */
class Ebizmarts_MailChimp_Block_Adminhtml_System_Config_Account extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $firstErrorKey = Ebizmarts_MailChimp_Model_System_Config_Source_Account::NO_STORE_TEXT_KEY;
        $firstMigrationKey = Ebizmarts_MailChimp_Model_System_Config_Source_Account::STORE_MIGRATION_TEXT_KEY;
        $syncLabelKey = Ebizmarts_MailChimp_Model_System_Config_Source_Account::SYNC_LABEL_KEY;
        $values = $element->getValues();
        $html = '<ul id="mailchimp_general_account_details" class="checkboxes">';

        foreach ($values as $dat) {
            if ($dat['value'] >= $firstErrorKey && $dat['value'] < $firstMigrationKey) {
                $html .= "<li style='color:red;font-weight: bold;'>{$dat['label']}</li>";
            } elseif ($dat['value'] == $firstMigrationKey) {
                $html .= "<li style='color:forestgreen;font-weight: bold;'>{$dat['label']}</li>";
            } elseif ($dat['value'] == $syncLabelKey) {
                $html = $this->getSyncFlagDataHtml($dat, $html);
            } else {
                $html .= "<li>{$dat['label']}</li>";
            }
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * @param $dat
     * @param $html
     * @return string
     */
    protected function getSyncFlagDataHtml($dat, $html)
    {
        $helper = $this->makeHelper();
        $html = $helper->getSyncFlagDataHtml($dat, $html);
        return $html;
    }

    /**
     * @return Ebizmarts_MailChimp_Helper_Data
     */
    protected function makeHelper()
    {
        return Mage::helper('mailchimp');
    }
}
