<?php

namespace code\Ebizmarts\MailChimp\Model use Ebizmarts_Mailchimp4Magentouse\Mage_Core_Model_Abstract;

Mage_Core_Model_Abstract;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model;
/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     6/9/16 4:44 PM
 * @file:     Mailchimperrors.php
 */
class Ebizmarts_MailChimp_Model_Mailchimperrors extends Mage_Core_Model_Abstract
{
    /**
     * Initialize model
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('mailchimp/mailchimperrors');
    }
}
