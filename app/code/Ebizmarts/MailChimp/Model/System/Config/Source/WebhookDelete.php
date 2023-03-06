<?php

namespace code\Ebizmarts\MailChimp\Model\System\Config\Source use Ebizmarts_Mailchimp4Magentouse\Mage;

Mage;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\System\Config\Source;
/**
 * MailChimp For Magento
 *
 * @category  Ebizmarts_MailChimp
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     5/19/16 3:55 PM
 * @file:     WebhookDelete.php
 */
class Ebizmarts_MailChimp_Model_System_Config_Source_WebhookDelete
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $mailchimpHelper = Mage::helper('mailchimp');

        return array(
            array('value' => 0, 'label' => $mailchimpHelper->__('Unsubscribe')),
            array('value' => 1, 'label' => $mailchimpHelper->__('Delete subscriber'))
        );
    }
}
