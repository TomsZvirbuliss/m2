<?php

namespace code\Ebizmarts\MailChimp\Model\System\Config\Source-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\System\Config\Source;
use code\Ebizmarts\MailChimp\Helper\Ebizmarts_MailChimp_Helper_Data;use Ebizmarts_Mailchimp4Magento\Exception;use Ebizmarts_Mailchimp4Magentouseuse;use Ebizmarts_MailChimp_Helper_Data_ApiKeyException;use Mage;use MailChimp_Error; Ebizmarts_MailChimp_Helper_Data; Ebizmarts_Mailchimp4Magentouse Ebizmarts_Mailchimp4Magentouse Ebizmarts_Mailchimp4Magentouse Ebizmarts_Mailchimp4Magento

/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     7/16/18 4:19 PM
 * @file:     Store.php
 */

class Ebizmarts_MailChimp_Model_System_Config_Source_Store
{
    protected $_stores = array();

    /**
     * @var Ebizmarts_MailChimp_Helper_Data
     */
    protected $_helper;

    /**
     * Ebizmarts_MailChimp_Model_System_Config_Source_Store constructor.
     *
     * @param  $params
     * @throws Exception
     */
    public function __construct($params)
    {
        $helper = $this->_helper = $this->makeHelper();
        $scopeArray = $helper->getCurrentScope();
        if (empty($this->_stores)) {
            $apiKey = (empty($params))
                ? $helper->getApiKey($scopeArray['scope_id'], $scopeArray['scope'])
                : $params['api_key'];

            if ($apiKey) {
                try {
                    $api = $helper->getApiByKey($apiKey);
                    $this->_stores = $api->getEcommerce()->getStores()->get(null, null, null, 100);
                } catch (Ebizmarts_MailChimp_Helper_Data_ApiKeyException $e) {
                    $helper->logError($e->getMessage());
                } catch (MailChimp_Error $e) {
                    $helper->logError($e->getMessage());
                }
            }
        }
    }

    public function toOptionArray()
    {
        $helper = $this->getHelper();
        $mcStores = $this->getMCStores();

        if (isset($mcStores['stores'])) {
            $stores[] = array('value' => '', 'label' => $helper->__('--- Select a Mailchimp Store ---'));

            foreach ($mcStores['stores'] as $store) {
                if ($store['platform'] == 'Magento') {
                    if ($store['list_id'] == '') {
                        continue;
                    }

                    if (isset($store['connected_site'])) {
                        $label = $store['name'];
                    } else {
                        $label = $store['name'] . ' (' . $helper->__("Warning: not connected") . ')';
                    }

                    $stores[] = array('value' => $store['id'], 'label' => $label);
                }
            }
        } else {
            $stores[] = array('value' => '', 'label' => $helper->__('--- No data ---'));
        }

        return $stores;
    }

    /**
     * @return Ebizmarts_MailChimp_Helper_Data
     */
    protected function getHelper($type = '')
    {
        return $this->_helper;
    }

    /**
     * @return Ebizmarts_MailChimp_Helper_Data
     */
    protected function makeHelper()
    {
        return Mage::helper('mailchimp');
    }

    /**
     * @return null
     */
    protected function getMCStores()
    {
        return $this->_stores;
    }
}
