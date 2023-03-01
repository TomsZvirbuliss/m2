<?php
/**
 * This file is part of the Magebit package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit Faq
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2022 Magebit, Ltd. (https://magebit.com/)
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Magebit\TaxRule\Setup\Patch\Data;

use Magento\Tax\Api\Data\TaxRateInterface;
use Magento\Tax\Api\Data\TaxRuleInterface;
use Magento\Tax\Api\Data\TaxRuleInterfaceFactory;
use Magento\Tax\Api\Data\TaxRateInterfaceFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Tax\Api\TaxRuleRepositoryInterface;
use Magento\Tax\Api\TaxRateRepositoryInterface;

class TaxRule implements DataPatchInterface, PatchVersionInterface
{
    const DEFAULT_TAX_RATE = 20;
    const DEFAULT_TAX_COUNTRY = "GB";
    const DEFAULT_CUSTOMER_TAX_CLASS_ID = 3;
    const DEFAULT_PRODUCT_TAX_CLASS_ID = 2;

    /**
     * @var TaxRateInterface
     */
    private $taxRateInterface;

    /**
     * @var TaxRuleInterface
     */
    private $taxRuleInterface;

    /**
     * @var TaxRateInterfaceFactory
     */
    private $taxRateFactory;

    /**
     * @var TaxRuleInterfaceFactory
     */
    private $taxRuleFactory;

    /**
     * @var TaxRuleRepositoryInterface
     */
    private $taxRuleRepository;

    /**
     * @var TaxRateRepositoryInterface
     */
    private $taxRateRepository;

    /**
     * Constructor
     * @param TaxRateInterface $taxRateInterface
     * @param TaxRuleInterface $taxRuleInterface
     * @param TaxRateInterfaceFactory $taxRateFactory
     * @param TaxRuleInterfaceFactory $taxRuleFactory
     * @param TaxRuleRepositoryInterface $taxRuleRepository
     * @param TaxRateRepositoryInterface $taxRateRepository
     */
    public function __construct(
        TaxRateInterface $taxRateInterface,
        TaxRuleInterface $taxRuleInterface,
        TaxRateInterfaceFactory $taxRateFactory,
        TaxRuleInterfaceFactory $taxRuleFactory,
        TaxRuleRepositoryInterface $taxRuleRepository,
        TaxRateRepositoryInterface $taxRateRepository
    )
    {
        $this->taxRuleInterface = $taxRuleInterface;
        $this->taxRateInterface = $taxRateInterface;
        $this->taxRateFactory = $taxRateFactory;
        $this->taxRuleFactory = $taxRuleFactory;
        $this->taxRuleRepository = $taxRuleRepository;
        $this->taxRateRepository = $taxRateRepository;
    }

    public function apply()
    {
        /** @var $taxRate TaxRateInterface */
        $taxRate = $this->taxRateFactory->create();
        $taxRate->setCode("UK-*-Rate 1")
            ->setRate(self::DEFAULT_TAX_RATE)
            ->setTaxCountryId(self::DEFAULT_TAX_COUNTRY)
            ->setTaxPostcode('*');

        $taxRateData = $this->taxRateRepository->save($taxRate);

        /** @var $taxRuleDataObject TaxRuleInterface */
        $taxRuleDataObject = $this->taxRuleFactory->create();
        $taxRuleDataObject->setCode("UK-*-Rate 1")
            ->setTaxRateIds([$taxRateData->getId()])
            ->setCustomerTaxClassIds([self::DEFAULT_CUSTOMER_TAX_CLASS_ID])
            ->setProductTaxClassIds([self::DEFAULT_PRODUCT_TAX_CLASS_ID])
            ->setPriority(0)
            ->setPosition(0);

        $this->taxRuleRepository->save($taxRuleDataObject);
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '2.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
?>
