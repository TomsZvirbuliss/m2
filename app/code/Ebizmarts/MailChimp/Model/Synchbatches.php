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
 * @date:     5/16/16 6:23 PM
 * @file:     MailchimpSychBatches.php
 */

class Ebizmarts_MailChimp_Model_Synchbatches extends Mage_Core_Model_Abstract
{
    /**
     * Initialize model
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('mailchimp/synchbatches');
    }
}
