<?php
namespace WeSupply\Toolbox\Api;

/**
 * Interface BlockRepositoryInterface
 * @package WeSupply\Toolbox\Api
 */
interface OrderInfoBuilderInterface
{

    /**
     * Gathers the informatio for wesupply api from Magento order id
     *
     * @param $order
     * @param $existingOrderData
     * @return mixed
     */
    public function gatherInfo($order, $existingOrderData);

    /**
     * Prepares the order information for db storage
     * @param array $orderData
     * @return string
     */
    public function prepareForStorage($orderData);

    /**
     * Returns the order last updated time
     * @param array $orderData
     * @return string
     */
    public function getUpdatedAt($orderData);

    /**
     * Return the store id from the order information array
     * @param array $orderData
     * @return int
     */
    public function getStoreId($orderData);
}
