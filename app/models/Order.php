<?php

class Order
{
    use Model;

    protected $table = 'medicineorder';
    protected $allowedColumns = ['OrderID', 'PatientID', 'Delivery Address', 'Date', 'Payment'];
    protected $order_column = "ProductID";

    public function getOrderDetails()
    {
        $sql = "Select * FROM $this->table";
        return $this->query($sql);
    }

    public function getMedicineOrder($orderID)
    {
        return $this->first(['OrderId' => $orderID]);
    }
}
