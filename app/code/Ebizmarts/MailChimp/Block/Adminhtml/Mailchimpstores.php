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
 * @date:     3/6/18 2:22 PM
 * @file:     Mailchimpstores.php
 */
class Ebizmarts_MailChimp_Block_Adminhtml_Mailchimpstores extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'mailchimp';
        $this->_controller = 'adminhtml_mailchimpstores';
        $this->_headerText = $this->__('Mailchimp stores');

        parent::__construct();
    }
}
