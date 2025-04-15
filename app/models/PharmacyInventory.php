<?php

class PharmacyInventory
{
    use Model;

    protected $table = 'pharmacyinventory';
    protected $allowedColumns = ['medicineNmae', 'brandName', 'genericName', 'category', 'supplierID', 'batchID', 'StockQuantity', 'reorderLevel', 'storageLocation', 'manufacturingDate', 'expiryDate', 'storageCondition', 'purchasePrice', 'sellingPrice', 'offers'];
    protected $order_column = "batchID";

    public function getInventoryDetails()
    {
        $sql = "Select * FROM $this->table";
        return $this->query($sql);
    }

    public function getMedicineInventory($batchID)
    {
        return $this->first(['batchID' => $batchID]);
    }

    public function getInventoryMedicines($batchID)
    {
        $where = ['batchID' => $batchID];
        // return $this->where($where, []);
        return $this->selectWhere(['medicineName', 'brandName', 'genericName', 'category', 'supplierID', 'batchID', 'stockQuantity', 'reorderLevel', 'storageLocation', 'manufacturingDate', 'expiryDate', 'storageConditions', 'purchasePrice', 'sellingPrice', 'offers'], $where, [], 'batchID ASC');
    }
}
