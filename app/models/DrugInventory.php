<?php

class DrugInventory
{
    use Model;

    protected $table = 'drugInventory';
    protected $allowedColumns = ['InventoryId', 'ProductID', 'PharmacyID', 'unitPrice', 'ongoingOrder', 'availableCount', 'thresholdLimit', 'storageLocation', 'storageConditions'];
    protected $order_column = ['InventoryId'];

    public function updateInventory($inventoryId, $threshold, $storageLocation, $storageConditions, $unitPrice)
    {
        // $query = "
        //     UPDATE drugInventory
        //     SET  thresholdLimit = ?, storageLocation = ?, storageConditions = ?, unitPrice = ?,
        //     WHERE InventoryId = ?;

        // ";

        $data = ['thresholdLimit' => $threshold, 'storageLocation' => $storageLocation, 'storageConditions' => $storageConditions, 'unitPrice' => $unitPrice];
        $conditions = ['InventoryId' => $inventoryId];


        // $data = [$threshold, $storageLocation, $storageConditions, $unitPrice, $inventoryId];

        return $this->updateWithConditions($data, $conditions);
    }

    public function addDrug($threshold, $storageLocation, $storageConditions, $unitPrice)
    {
        $query = "INSERT INTO drugInventory (drugInventory.thresholdLimit,drugInventory.storageLocation,drugInventory.storageConditions,drugInventory.unitPrice) 
        VALUES
        (:InventoryId,:thresholdLimit,:storageLocation,:storageConditions,:unitPrice)";

        $data = [
            // 'InventoryId' => $inventoryId,
            'thresholdLimit' => $threshold,
            'storageLocation' => $storageLocation,
            'storageConditions' => $storageConditions,
            'unitPrice' => $unitPrice
        ];

        $results = $this->query($query, $data);
        return $results;
    }
}
