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
                'orderId' => $orderID,
                'productId' => $productID,
                'quantity' => $quantities[$key]
            ];
        }
        $this->insertBatch($orderList);
    }

    public function updateOrderList($orderID, $productIDs, $quantities, $removedProductIDs)
    {
        // Remove items
        foreach ($removedProductIDs as $productID) {
            $this->deleteWithConditions(['orderId' => $orderID, 'productId' => $productID]);
        }

        // Update or add items
        foreach ($productIDs as $index => $productID) {
            $data = ['quantity' => $quantities[$index]];
            $conditions = [
                'orderId' => $orderID,
                'productId' => $productID
            ];

            // Check if the item already exists
            $existingItem = $this->first(['orderId' => $orderID, 'productId' => $productID]);

            // show($existingItem);
            if ($existingItem) {
                // Update existing item
                $this->updateWithConditions($data, $conditions);
            } else {
                // Add new item
                $data = [
                    'OrderID' => $orderID,
                    'ProductID' => $productID,
                    'quantity' => $quantities[$index]
                ];

                $this->insert($data);
            }
        }
    }
}
