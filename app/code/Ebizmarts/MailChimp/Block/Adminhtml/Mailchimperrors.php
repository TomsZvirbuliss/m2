<?php

namespace code\Ebizmarts\MailChimp\Block\Adminhtml use Ebizmarts_Mailchimp4Magentouse\Mage_Adminhtml_Block_Widget_Grid_Container;

Mage_Adminhtml_Block_Widget_Grid_Container;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Block\Adminhtml;
/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     6/10/16 1:42 PM
 * @file:     Mailchimperrors.php
 */
class Ebizmarts_MailChimp_Block_Adminhtml_Mailchimperrors extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'mailchimp';
        $this->_controller = 'adminhtml_mailchimperrors';
        $this->_headerText = $this->__('Mailchimp errors');

        parent::__construct();
        $this->removeButton('add');
    }
}
