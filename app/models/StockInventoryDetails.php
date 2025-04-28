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

    public function checkPharmacyInventory($inventoryID, $pharmacyID)
    {
        $query = "SELECT * FROM $this->table WHERE InventoryId = :InventoryId AND PharmacyID = :PharmacyID";
        $data = ['InventoryId' => $inventoryID, 'PharmacyID' => $pharmacyID];
        return $this->query($query, $data);
    }

    public function getInventoryMedicines($inventoryID)
    {
        $where = ['InventoryId' => $inventoryID];
        // return $this->where($where, []);
        return $this->selectWhere(['ProductName', 'Manufacturer', 'genericName', 'category', 'batchNumber', 'LastStockQuantity', 'thresholdLimit', 'storageLocation', 'manufacturingDate', 'expiryDate', 'storageConditions', 'purchaseCost', 'sellingPrice'], $where, [], 'InventoryId ASC');
    }


    public function getInventoryDetails()
    {
        $sql = "Select * FROM $this->table";
        return $this->query($sql);
    }

    public function getInventoryByPharmacy($pharmacyID)
    {
        $query = "SELECT * FROM $this->table WHERE PharmacyID = :PharmacyID ORDER BY InventoryID DESC";
        return $this->query($query, ['PharmacyID' => $pharmacyID]);
    }
}
