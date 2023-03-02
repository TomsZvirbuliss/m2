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
use Magento\Tax\Api\Data\TaxClassInterface;
use Magento\Tax\Api\Data\TaxRuleInterface;
use Magento\Tax\Api\Data\TaxRuleInterfaceFactory;
use Magento\Tax\Api\Data\TaxRateInterfaceFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Tax\Api\TaxRuleRepositoryInterface;
use Magento\Tax\Api\TaxRateRepositoryInterface;
use Magento\Tax\Api\TaxClassRepositoryInterface;
use Magento\Tax\Api\Data\TaxClassInterfaceFactory;
use Magento\Directory\Model\ResourceModel\Country\Collection;
use Magento\Tax\Model\Calculation\Rate;

class TaxRule implements DataPatchInterface, PatchVersionInterface
{
    const DEFAULT_TAX_RATE = 5;
    const DEFAULT_CUSTOMER_TAX_CLASS_ID = 3;
    const GREAT_BRITTAIN_RATE = "UK-*-Rate 1";
    const UK_TAX_COUNTRY = "GB";
    const UK_TAX_RATE = 20;
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
     * @var TaxClassInterface
     */
    private $taxClassInterface;

    /**
     * @var TaxClassRepositoryInterface
     */
    private $taxClassRepository;

    /**
     * @var TaxClassInterfaceFactory
     */
    private $taxClassFactory;

    /**
     * @var Collection
     */
    private $country;

    /**
     * @var Rate
     */
    private $rate;

    /**
     * Constructor
     * @param TaxRateInterface $taxRateInterface
     * @param TaxRuleInterface $taxRuleInterface
     * @param TaxRateInterfaceFactory $taxRateFactory
     * @param TaxRuleInterfaceFactory $taxRuleFactory
     * @param TaxRuleRepositoryInterface $taxRuleRepository
     * @param TaxRateRepositoryInterface $taxRateRepository
     * @param TaxClassInterface $taxClassInterface
     * @param TaxClassRepositoryInterface $taxClassRepository
     * @param TaxClassInterfaceFactory $taxClassFactory
     * @param Collection $country
     * @param Rate $rate
     */
    public function __construct(
        TaxRateInterface $taxRateInterface,
        TaxRuleInterface $taxRuleInterface,
        TaxRateInterfaceFactory $taxRateFactory,
        TaxRuleInterfaceFactory $taxRuleFactory,
        TaxRuleRepositoryInterface $taxRuleRepository,
        TaxRateRepositoryInterface $taxRateRepository,
        TaxClassInterface $taxClassInterface,
        TaxClassRepositoryInterface $taxClassRepository,
        TaxClassInterfaceFactory $taxClassFactory,
        Collection $country,
        Rate $rate
    )
    {
        $this->taxRuleInterface = $taxRuleInterface;
        $this->taxRateInterface = $taxRateInterface;
        $this->taxRateFactory = $taxRateFactory;
        $this->taxRuleFactory = $taxRuleFactory;
        $this->taxRuleRepository = $taxRuleRepository;
        $this->taxRateRepository = $taxRateRepository;
        $this->taxClassInterface = $taxClassInterface;
        $this->taxClassRepository = $taxClassRepository;
        $this->taxClassFactory = $taxClassFactory;
        $this->country = $country;
        $this->rate = $rate;
    }


    public function apply()
    {
        $this->createUkRate();
        /** @var $taxClass TaxClassInterface */
        $taxClass = $this->taxClassFactory->create();
        $taxClass->setClassName("Single 5% tax")
            ->setClassType("PRODUCT");

        $taxClass = $this->taxClassRepository->save($taxClass);

        $countries = $this->country->loadByStore()->getData();
        $taxRateIds = array();
        foreach ($countries as $countrie) {
            /** @var $taxRate TaxRateInterface */
            $taxRate = $this->taxRateFactory->create();
            $taxRate->setCode($countrie["country_id"]."-Global-*-Rate")
                ->setRate(self::DEFAULT_TAX_RATE)
                ->setTaxCountryId($countrie["country_id"])
                ->setTaxPostcode('*');

            $taxRateData = $this->taxRateRepository->save($taxRate);
            $taxRateIds[] = $taxRateData->getId();
        }

        for ($x = 1; $x <= 2; $x++) {
            if ($x == 1) {
                $name = "5% Global-Rate";
            } else {
                $taxRateIds = [$this->rate->loadByCode(self::GREAT_BRITTAIN_RATE)->getId()];
                $name = "Custom 20% Rate";
            }

            /** @var $taxRuleDataObject TaxRuleInterface */
            $taxRuleDataObject = $this->taxRuleFactory->create();
            $taxRuleDataObject->setCode($name)
                ->setTaxRateIds($taxRateIds)
                ->setCustomerTaxClassIds([self::DEFAULT_CUSTOMER_TAX_CLASS_ID])
                ->setProductTaxClassIds([$taxClass])
                ->setPriority(0)
                ->setPosition(0);

            $this->taxRuleRepository->save($taxRuleDataObject);
        }
    }

    /**
     * Creates Tax rate for United Kingdom
     * @return null
     */
    public function createUkRate() {
        /** @var $taxRate TaxRateInterface */
        $taxRate = $this->taxRateFactory->create();
        $taxRate->setCode("UK-*-Rate 1")
            ->setRate(self::UK_TAX_RATE)
            ->setTaxCountryId(self::UK_TAX_COUNTRY)
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
