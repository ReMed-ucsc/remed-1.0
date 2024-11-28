<?php

class OrderList
{
    use Model;

    protected $table = 'orderList';
    protected $allowedColumns = ['OrderID', 'ProductID', 'quantity'];
    protected $order_column = "OrderID";

    public function setOrderList($orderID, $productIDs, $quantities)
    {
        $orderList = [];
        foreach ($productIDs as $key => $productID) {
            $orderList[] = [
                'OrderID' => $orderID,
                'ProductID' => $productID,
                'quantity' => $quantities[$key]
            ];
        }
        $this->insertBatch($orderList);
    }

    public function updateOrderList($orderID, $productIDs, $quantities, $removedProductIDs)
    {
        // Remove items
        foreach ($removedProductIDs as $productID) {
            $this->deleteWithConditions(['orderID' => $orderID, 'productID' => $productID]);
        }

        // Update or add items
        foreach ($productIDs as $index => $productID) {
            $data = [
                'orderID' => $orderID,
                'productID' => $productID,
                'quantity' => $quantities[$index]
            ];

            // Check if the item already exists
            $existingItem = $this->first(['orderID' => $orderID, 'productID' => $productID]);

            if ($existingItem) {
                // Update existing item
                $this->update($existingItem->id, $data);
            } else {
                // Add new item
                $this->insert($data);
            }
        }
    }
}
