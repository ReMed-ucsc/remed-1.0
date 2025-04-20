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
                'orderID' => $orderID,
                'ProductID' => $productID,
                'quantity' => $quantities[$key]
            ];
        }
        // show($orderList);
        return $this->insertBatch($orderList);
    }

    public function updateOrderList($orderID, $productIDs, $quantities, $removedProductIDs)
    {
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

        // Remove items
        // Check if the order list will empty after deletion
        if ($this->count('orderID', ['orderId' => $orderID]) > sizeof($removedProductIDs)) {
            foreach ($removedProductIDs as $productID) {
                $this->deleteWithConditions(['orderId' => $orderID, 'productId' => $productID]);
            }
        } else {
            return ['error' => true, 'message' => 'Order list will empty'];
        }

        return ['error' => false, 'message' => 'Order list updated successfully'];
    }
}
