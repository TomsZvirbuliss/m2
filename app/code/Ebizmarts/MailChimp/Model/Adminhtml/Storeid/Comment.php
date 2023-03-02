<?php

namespace code\Ebizmarts\MailChimp\Model\Adminhtml\Storeid use Ebizmarts_Mailchimp4Magentouse\Mage;

Mage;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\Adminhtml\Storeid;
class Ebizmarts_MailChimp_Model_Adminhtml_Storeid_Comment
{
    public function getCommentText()
    {
        $helper = Mage::helper('mailchimp');
        return $helper->__(
                'Select the Mailchimp store you want to associate with this scope. '
                . 'You can create a new store at '
            )
            . '<a target="_blank" href="'
            . Mage::helper('adminhtml')->getUrl('adminhtml/mailchimpstores/index')
            . '">' . $helper->__('Newsletter -> Mailchimp -> Mailchimp Stores') . '</a>';
    }
}
