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

    public function getAvailableCount($productId, $pharmacyId)
    {
        $query = "SELECT availableCount FROM drugInventory WHERE ProductID = :productId AND PharmacyID = :pharmacyId ORDER BY DrugInventoryID DESC LIMIT 1";

        $result = $this->query($query, [
            'productId' => $productId,
            'pharmacyId' => $pharmacyId
        ]);

        return $result[0]->availableCount ?? 0;
    }


    public function addDrug($productId, $pharmacyId, $stockQuantity, $threshold, $storageLocation, $storageConditions, $unitPrice)
    {
        // $query = "INSERT INTO drugInventory (ProductID, PharmacyID, availableCount, drugInventory.thresholdLimit,drugInventory.storageLocation,drugInventory.storageConditions,drugInventory.unitPrice) 
        // VALUES
        // (:ProductID, :PharmacyID, :availableCount, :thresholdLimit,:storageLocation,:storageConditions,:unitPrice)";

        $availableCount = $this->getAvailableCount($productId, $pharmacyId);

        $newAvailableCount = $stockQuantity + $availableCount;

        $data = [
            // 'InventoryId' => $inventoryId,
            'ProductID' => $productId,
            'PharmacyID' => $pharmacyId,
            'availableCount' => $newAvailableCount,
            'thresholdLimit' => $threshold,
            'storageLocation' => $storageLocation,
            'storageConditions' => $storageConditions,
            'unitPrice' => $unitPrice
        ];

        $success = $this->insert($data);

        // If the insertion was successful, retrieve the last inserted ID
        if ($success) {
            return $this->lastInsertId();
        }

        // Return false if the insertion failed
        return false;
    }
}
