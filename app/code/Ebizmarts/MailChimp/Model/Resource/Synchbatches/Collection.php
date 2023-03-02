<?php

namespace code\Ebizmarts\MailChimp\Model\Resource\Synchbatches use Ebizmarts_Mailchimp4Magentouse\Mage_Core_Model_Resource_Db_Collection_Abstract;

Mage_Core_Model_Resource_Db_Collection_Abstract;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\Resource\Synchbatches;
/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     2019-10-02 15:58
 */
class Ebizmarts_MailChimp_Model_Resource_Synchbatches_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Set resource type
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('mailchimp/synchbatches');
    }
}
