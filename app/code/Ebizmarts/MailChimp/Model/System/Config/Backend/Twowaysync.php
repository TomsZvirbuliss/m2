<?php

namespace code\Ebizmarts\MailChimp\Model\System\Config\Backend-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\System\Config\Backend;
use code\Ebizmarts\MailChimp\Helper\Ebizmarts_MailChimp_Helper_Data;use Ebizmarts_Mailchimp4Magentouseuse;use Ebizmarts_MailChimp_Helper_Webhook;use Mage;use Mage_Core_Model_Config_Data; Ebizmarts_MailChimp_Helper_Data; Ebizmarts_Mailchimp4Magento

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
class Ebizmarts_MailChimp_Model_System_Config_Backend_Twowaysync extends Mage_Core_Model_Config_Data
{
    protected function _afterSave()
    {
        $helper = $this->makeHelper();
        $webhookHelper = $this->makeWebhookHelper();
        $groups = $this->getData('groups');
        $moduleIsActive = (isset($groups['general']['fields']['active']['value']))
            ? $groups['general']['fields']['active']['value']
            : $helper->isMailChimpEnabled($this->getScopeId(), $this->getScope());
        $apiKey = (isset($groups['general']['fields']['apikey']['value']))
            ? $groups['general']['fields']['apikey']['value']
            : $helper->getApiKey($this->getScopeId(), $this->getScope());
        $listId = $helper->getGeneralList($this->getScopeId(), $this->getScope());
        if ($apiKey && $moduleIsActive && $listId && $this->isValueChanged()) {
            $webhookHelper->handleWebhookChange($this->getScopeId(), $this->getScope());
        }
    }

    /**
     * @return Ebizmarts_MailChimp_Helper_Data
     */
    protected function makeHelper()
    {
        return Mage::helper('mailchimp');
    }

    /**
     * @return \code\Ebizmarts\MailChimp\Helper\Ebizmarts_MailChimp_Helper_Webhook
     */
    protected function makeWebhookHelper()
    {
        return Mage::helper('mailchimp/webhook');
    }
}
