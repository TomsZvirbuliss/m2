<?php

namespace code\Ebizmarts\MailChimp\Block\Adminhtml\System\Config-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Block\Adminhtml\System\Config;
use code\Ebizmarts\MailChimp\Helper\Ebizmarts_MailChimp_Helper_Data;use Ebizmarts_Mailchimp4Magentouseuse;use Ebizmarts_MailChimp_Model_Config;use Mage_Adminhtml_Block_System_Config_Form_Field;use Varien_Data_Form_Element_Abstract; Ebizmarts_MailChimp_Helper_Data; Ebizmarts_Mailchimp4Magento
/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     5/27/16 1:16 PM
 * @file:     ResendEcommerceData.php
 */
class Ebizmarts_MailChimp_Block_Adminhtml_System_Config_ResendEcommerceData
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('ebizmarts/mailchimp/system/config/resendecommercedata.phtml');
    }

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }

    public function getButtonHtml()
    {
        $helper = $this->makeHelper();
        $scopeArray = $helper->getCurrentScope();
        if ($helper->getIfConfigExistsForScope(
            Ebizmarts_MailChimp_Model_Config::GENERAL_MCSTOREID,
            $scopeArray['scope_id'],
            $scopeArray['scope']
        )
        ) {
            $label = $helper->__('Resend Ecommerce Data');
            $button = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(
                    array(
                        'id' => 'resendecommercedata_button',
                        'label' => $label,
                        'onclick' => 'javascript:openResendEcommerceDialog(); return false;',
                        'title' => $helper->__('Resend Ecommerce Data current scope')
                    )
                );

            return $button->toHtml();
        }
    }

    /**
     * @return Ebizmarts_MailChimp_Helper_Data
     */
    protected function makeHelper()
    {
        return $this->helper('mailchimp');
    }
}
