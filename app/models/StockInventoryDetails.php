<?php

class StockInventoryDetails
{
    use Model;

    protected $table = 'StockInventoryDetails';
    protected $allowedColumns = ['InventoryId', 'PharmacyID', 'PharmacyName', 'ProductID', 'ProductName', 'genericName', 'category', 'strength', 'Manufacturer', 'SellingPrice', 'availableCount', 'thresholdLimit', 'storageLocation', 'storageConditions', 'LastStockID', 'LastStockQuantity', 'manufacturingDate', 'expiryDate', 'purchaseDate', 'purchaseCost', 'batchNumber'];
    protected $order_column = "InventoryId";


    public function getMedicineInventory($inventoryID)
    {
        return $this->first(['InventoryId' => $inventoryID]);
    }

    public function getInventoryMedicines($inventoryID)
    {
        $where = ['InventoryId' => $inventoryID];
        // return $this->where($where, []);
        return $this->selectWhere(['ProductName', 'Manufacturer', 'genericName', 'category', 'batchNumber', 'LastStockQuantity', 'thresholdLimit', 'storageLocation', 'manufacturingDate', 'expiryDate', 'storageConditions', 'purchaseCost', 'sellingPrice'], $where, [], 'InventoryId ASC');
    }

    public function addInventory($medicineName, $brandName, $genericName, $category, $batchID, $StockQuantity, $reorderLevel, $storageLocation, $manufacturingDate, $expiryDate, $storageCondition, $purchasePrice, $sellingPrice)
    {
        $data = [
            'ProductName' => $medicineName,
            'Manufacturer' => $brandName,
            'genericName' => $genericName,
            'category' => $category,
            'batchNumber' => $batchID,
            'availableCount' => $StockQuantity,
            'thresholdLimit' => $reorderLevel,
            'storageLocation' => $storageLocation,
            'manufacturingDate' => $manufacturingDate,
            'expiryDate' => $expiryDate,
            'storageCondition' => $storageCondition,
            'purchaseCost' => $purchasePrice,
            'sellingPrice' => $sellingPrice

        ];
        return $this->insert($data);
    }

    public function getInventoryDetails()
    {
        $sql = "Select * FROM $this->table";
        return $this->query($sql);
    }
}
