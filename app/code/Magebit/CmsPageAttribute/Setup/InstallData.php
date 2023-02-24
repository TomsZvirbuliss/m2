<?php

namespace Magebit\CmsPageAttribute\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Catalog\Model\Category;
use Magento\Framework\DB\Ddl\Table;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $setup->getConnection()->addColumn(
            $setup->getTable('cms_page'),
            'pre_footer_text',
            [
                'type' => Table::TYPE_TEXT,
                'length' => '255',
                'nullable' => true,
                'comment' => 'Text that renders before footer if set'
            ]
        );

        $installer->endSetup();
    }
}

