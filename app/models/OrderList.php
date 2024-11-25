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
}
