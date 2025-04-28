<?php

class DrugInventory
{
    use Model;

    protected $table = 'drugInventory';
    protected $allowedColumns = ['InventoryId', 'ProductID', 'PharmacyID', 'unitPrice', 'ongoingOrder', 'availableCount', 'thresholdLimit', 'storageLocation', 'storageConditions'];
    protected $order_column = ['InventoryId'];

    public function updateInventory($inventoryId, $threshold, $storageLocation, $storageConditions, $unitPrice)
    {


        $data = ['thresholdLimit' => $threshold, 'storageLocation' => $storageLocation, 'storageConditions' => $storageConditions, 'unitPrice' => $unitPrice];
        $conditions = ['InventoryId' => $inventoryId];



        return $this->updateWithConditions($data, $conditions);
    }

    public function updateStock($inventoryId, $stockQuantity)
    {
        $query = "UPDATE $this->table 
        SET availableCount = availableCount + ?
        WHERE InventoryId = ?";
        $data = [$stockQuantity, $inventoryId];

        return $this->query($query, $data);
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

    public function getPhramcyInventoryMedicines($pharmacyID)
    {
        $conditions = [
            'PharmacyID' => $pharmacyID,
            'availableCount' => ['operator' => '>', 'value' => 0]
        ];

        return $this->selectWhere(['ProductID'], $conditions);
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

    public function getStockLevelCountsArray($pharmacyId)
    {
        $query = "
            SELECT 
                SUM(CASE WHEN stockLevel = 'i' THEN 1 ELSE 0 END) as inStock,
                SUM(CASE WHEN stockLevel = 'l' THEN 1 ELSE 0 END) as lowStock,
                SUM(CASE WHEN stockLevel = 'o' THEN 1 ELSE 0 END) as outOfStock
            FROM 
                $this->table 
            WHERE 
                PharmacyID = :pharmacyId";

        $params = ['pharmacyId' => $pharmacyId];
        $result = $this->query($query, $params);

        if ($result) {
            // Return as a simple numeric array
            return [
                (int)$result[0]->inStock,
                (int)$result[0]->lowStock,
                (int)$result[0]->outOfStock
            ];
        }

        // Return zeros if no results
        return [0, 0, 0];
    }
}
