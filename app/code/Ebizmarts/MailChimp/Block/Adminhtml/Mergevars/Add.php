<?php

namespace code\Ebizmarts\MailChimp\Block\Adminhtml\Mergevars Mage;

use Ebizmarts_Mailchimp4Magentouse\Mage;
use Mage_Adminhtml_Block_Widget_Form_Container;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Block\Adminhtml\Mergevars;
/**
 * Author : Ebizmarts <info@ebizmarts.com>
 * Date   : 4/24/13
 * Time   : 1:15 PM
 * File   : Add.php
 * Module : Ebizmarts_MailChimp
 */
class Ebizmarts_MailChimp_Block_Adminhtml_Mergevars_Add extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected $_mode = 'add';

    public function __construct()
    {
        $this->_controller = 'adminhtml_mergevars';
        $this->_blockGroup = 'mailchimp';

        parent::__construct();
        $this->_removeButton("delete");
        $this->_removeButton("back");
        $this->_removeButton("reset");
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        return Mage::helper('mailchimp')->__('New Field Type');
    }
}
