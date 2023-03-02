<?php

//resource
namespace code\Ebizmarts\MailChimp\Model\Resource\Ecommercesyncdata-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\Resource\Ecommercesyncdata;
use code\Ebizmarts\MailChimp\Model\Ebizmarts_MailChimp_Model_Config;use Ebizmarts_Mailchimp4Magentouseuse;use Ebizmarts_MailChimp_Model_Resource_Ecommercesyncdata; Ebizmarts_MailChimp_Model_Config; Ebizmarts_Mailchimp4Magento


/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     2019-11-04 17:41
 */
class Ebizmarts_MailChimp_Model_Resource_Ecommercesyncdata_Product extends
    Ebizmarts_MailChimp_Model_Resource_Ecommercesyncdata
{
    public function _construct()
    {
        parent::_construct();
        $this->setType(Ebizmarts_MailChimp_Model_Config::IS_PRODUCT);
    }
}

