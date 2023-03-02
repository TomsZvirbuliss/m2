<?php

namespace code\Ebizmarts\MailChimp\controllers\Adminhtml-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\controllers\Adminhtml;
use code\Ebizmarts\MailChimp\Helper\Ebizmarts_MailChimp_Helper_Data;use Ebizmarts_Mailchimp4Magentouseuse;use Ebizmarts_MailChimp_Model_Config;use Mage;use Mage_Adminhtml_Controller_Action;use function Ebizmarts_Mailchimp4Magento\count; Ebizmarts_MailChimp_Helper_Data; Ebizmarts_Mailchimp4Magento

/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @file:     MergevarsController.php
 */
class Ebizmarts_MailChimp_Adminhtml_MergevarsController extends Mage_Adminhtml_Controller_Action
{

    public function addmergevarAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveaddAction()
    {
        $postData = $this->getRequest()->getPost('mergevar', array());
        $label = $postData['label'];
        $value = $postData['value'];
        $fieldType = $postData['fieldtype'];
        $helper = $this->makeHelper();
        $scopeArray = $helper->getCurrentScope();
        $blankSpacesAmount = (count(explode(' ', $value)) - 1);

        if (is_numeric($value)) {
            Mage::getSingleton('adminhtml/session')
                ->addError(
                    $this->__(
                        'There was an error processing the new field. '
                        . 'MailChimp tag value can not be numeric.'
                    )
                );
        } elseif ($helper->customMergeFieldAlreadyExists($value, $scopeArray['scope_id'], $scopeArray['scope'])) {
            Mage::getSingleton('adminhtml/session')
                ->addError(
                    $this->__(
                        'There was an error processing the new field. '
                        . 'MailChimp tag value already exists.'
                    )
                );
        } elseif ($blankSpacesAmount > 0) {
            Mage::getSingleton('adminhtml/session')
                ->addError(
                    $this->__(
                        'There was an error processing the new field. '
                        . 'MailChimp tag value can not contain blank spaces.'
                    )
                );
        } else {
            $customMergeFields = $helper->getCustomMergeFields($scopeArray['scope_id'], $scopeArray['scope']);
            $customMergeFields[] = array('label' => $label, 'value' => $value, 'field_type' => $fieldType);
            $configValues = array(
                array(
                    Ebizmarts_MailChimp_Model_Config::GENERAL_CUSTOM_MAP_FIELDS, $helper->serialize($customMergeFields)
                )
            );
            $helper->saveMailchimpConfig($configValues, $scopeArray['scope_id'], $scopeArray['scope']);
            Mage::getSingleton('core/session')->setMailChimpValue($value);
            Mage::getSingleton('core/session')->setMailChimpLabel($label);
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The custom value was added successfully.'));
        }

        $this->_redirect("*/*/addmergevar");
    }

    protected function _isAllowed()
    {
        switch ($this->getRequest()->getActionName()) {
            case 'addmergevar':
            case 'saveadd':
                $acl = 'system/config/mailchimp';
                break;
        }

        return Mage::getSingleton('admin/session')->isAllowed($acl);
    }

    /**
     * @return Ebizmarts_MailChimp_Helper_Data
     */
    protected function makeHelper()
    {
        return Mage::helper('mailchimp');
    }
}
