<?php

namespace code\Ebizmarts\MailChimp\Model\Resource\Ecommercesyncdata\Quote-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\Resource\Ecommercesyncdata\Quote;
use code\Ebizmarts\MailChimp\Model\Ebizmarts_MailChimp_Model_Config;use Ebizmarts_Mailchimp4Magentouseuse;use Ebizmarts_MailChimp_Model_Resource_Ecommercesyncdata_Collection;use Mage_Sales_Model_Resource_Quote_Collection; Ebizmarts_MailChimp_Model_Config; Ebizmarts_Mailchimp4Magento

/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     2019-11-04 17:32
 */
class Ebizmarts_MailChimp_Model_Resource_Ecommercesyncdata_Quote_Collection extends
    Ebizmarts_MailChimp_Model_Resource_Ecommercesyncdata_Collection
{

    /**
     * Set resource type
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
    }

    /**
     * @param Mage_Sales_Model_Resource_Quote_Collection $preFilteredQuotesCollection
     */
    public function joinLeftEcommerceSyncData($preFilteredQuotesCollection)
    {
        $mailchimpTableName = $this->getMailchimpEcommerceDataTableName();
        $preFilteredQuotesCollection->getSelect()->joinLeft(
            array('m4m' => $mailchimpTableName),
            "m4m.related_id = main_table.entity_id AND m4m.type = '" . Ebizmarts_MailChimp_Model_Config::IS_QUOTE
            . "' AND m4m.mailchimp_store_id = '" . $this->getMailchimpStoreId() . "'",
            array('m4m.*')
        );
    }
}
