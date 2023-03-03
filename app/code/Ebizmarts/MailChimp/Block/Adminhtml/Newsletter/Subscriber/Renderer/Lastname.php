<?php

namespace code\Ebizmarts\MailChimp\Block\Adminhtml\Newsletter\Subscriber\Renderer Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract;

use Ebizmarts_Mailchimp4Magentouse\Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract;
use Varien_Object;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Block\Adminhtml\Newsletter\Subscriber\Renderer;
/**
 * Created by PhpStorm.
 * User: santisp
 * Date: 22/05/15
 * Time: 05:23 PM
 */
class Ebizmarts_MailChimp_Block_Adminhtml_Newsletter_Subscriber_Renderer_Lastname
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $subscriberLastName = $row->getData('subscriber_lastname');
        $customerLastName = $row->getData('customer_lastname');
        if ($customerLastName) {
            return $this->escapeHtml($customerLastName);
        } elseif ($subscriberLastName) {
            return $this->escapeHtml($subscriberLastName);
        } else {
            return '----';
        }
    }
}