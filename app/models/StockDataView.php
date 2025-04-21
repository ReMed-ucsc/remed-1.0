<?php

class StockDataView
{
    use Model;

    protected $table = ['stockPurchase'];
    protected $allowedColumns = ['StockID', 'InventoryID', 'stockQuantity', 'purchaseDate', 'purchaseCost'];
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
}
