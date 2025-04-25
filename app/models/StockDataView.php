<?php

class StockDataView
{
    use Model;

    protected $table = 'stockPurchase';
    protected $allowedColumns = ['StockID', 'InventoryID', 'stockQuantity', 'manufacturingDate', 'expiryDate', 'purchaseDate', 'purchaseCost', 'batchNumber'];

    protected $order_column = ['StockID'];

    public function getMedicineStockPurchaseDetails($pharmacyId, $month, $year)
    {
        $query = "
            SELECT stockPurchase.purchaseCost, stockPurchase.stockQuantity, stockPurchase.InventoryId
            FROM stockPurchase
            JOIN drugInventory ON stockPurchase.InventoryID = drugInventory.InventoryId
            JOIN pharmacy ON drugInventory.PharmacyID = pharmacy.PharmacyID
            WHERE pharmacy.PharmacyID = :PharmacyId
            AND MONTH(stockPurchase.purchaseDate) = :Month
            AND YEAR(stockPurchase.purchaseDate) = :Year;
        ";

        $data = [
            "PharmacyId" => $pharmacyId,
            "Month" => $month,
            "Year" => $year
        ];

        $result = $this->query($query, $data);

        return $result;
    }

    public function addStock($inventoryID, $stockQuantity, $manufacturerDate, $expiryDate, $purchaseCost, $purchaseDate, $batchNumber)
    {
        //     $query = "
        //         INSERT INTO stockPurchase (stockPurchase.InventoryID,stockPurchase.stockQuantity,stockPurchase.manufacturingDate,stockPurchase.expiryDate,stockPurchase.purchaseDate,stockPurchase.purchaseCost,stockPurchase.batchNumber)
        //         Values
        // (:InventoryID,:stockQuantity,:manufacturingDate,:expiryDate,:purchaseDate,:purchaseCost, :batchNumber)

        //     ";

        $data = [
            'InventoryID' => $inventoryID,
            'stockQuantity' => $stockQuantity,
            'manufacturingDate' => $manufacturerDate,
            'expiryDate' => $expiryDate,
            'purchaseDate' => $purchaseDate,
            'purchaseCost' => $purchaseCost,
            'batchNumber' => $batchNumber
        ];

        $success = $this->insert($data);

        // If the insertion was successful, retrieve the last inserted ID
        if ($success) {
            return $this->lastInsertId();
        }

        // Return false if the insertion failed
        return false;
    }

    public function getPurchaseHistory($inventoryID)
    {
        $data = "SELECT purchaseDate FROM stockPurchase WHERE inventoryID = ? ORDER BY purchaseDate DESC";
        return $this->query($data, [$inventoryID]);
    }

    public function getStockDetails($inventoryID)
    {
        $data = "SELECT * FROM stockPurchase WHERE inventoryID = ?";
        return $this->query($data, [$inventoryID]);
    }
}
