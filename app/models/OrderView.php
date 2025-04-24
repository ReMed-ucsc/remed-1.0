<?php

class OrderView
{
    use Model;

    protected $table = 'OrderView';
    protected $allowedColumns = ['OrderID', 'PatientID', 'MedicineID', 'Quantity', 'PharmacyID'];
    protected $order_column = "OrderID";


    // order status categories
    private $WAITING = 'W';
    private $PROCESSING = 'P';
    private $ACCEPT_QUOTATION = 'Q';
    private $DELIVERED = 'D';
    private $USER_PICKED_UP = 'U';
    private $REJECTED = 'R';            // user rejects order after reviewing quotation
    private $DELIVERY_FAILED = 'F';
    private $ACCEPTED = 'A';            // user accepts the order after reviewing quotation
    private $WAITING_FOR_DRIVER = 'WD'; // waiting for driver to accept the order
    private $DELIVERY_IN_PROGRESS = 'I';
    private $DELIVERY_CANCEL = 'DC';
    private $DELIVERY_COMPLETED = 'C';
    private $WAITING_FOR_PICKUP = 'WP';

    public function getOrderDetails($orderID)
    {
        return $this->first(['OrderID' => $orderID]);
    }

    public function getOrderMedicines($orderID)
    {
        $where = ['orderId' => $orderID];
        // return $this->where($where, []);
        return $this->selectWhere(['ProductID', 'ProductName', 'genericName', 'ManufactureName', 'strength', 'unitPrice', 'quantity'], $where, [], 'ProductID ASC');
    }

    // public function getOrderMedicines($orderID)
    // {
    //     $query = "SELECT * FROM $this->table WHERE OrderID = :orderID";
    //     $data = ['orderID' => $orderID];
    //     return $this->query($query, $data);
    // }

    public function getOrder($orderID, $patientID)
    {
        $query = "SELECT * FROM $this->table WHERE OrderID = :orderID AND PatientID = :patientID";
        $data = ['orderID' => $orderID, 'patientID' => $patientID];
        return $this->query($query, $data);
    }

    public function getStatusName($status)
    {
        $statusMap = [
            $this->WAITING => 'WAITING',
            $this->PROCESSING => 'PROCESSING',
            $this->ACCEPT_QUOTATION => 'ACCEPT QUOTATION',
            $this->DELIVERED => 'DELIVERED',
            $this->USER_PICKED_UP => 'USER PICKED UP',
            $this->REJECTED => 'REJECTED',
            $this->DELIVERY_FAILED => 'DELIVERY FAILED',
            $this->ACCEPTED => 'ACCEPTED',
            $this->WAITING_FOR_DRIVER => 'WAITING FOR DRIVER',
            $this->DELIVERY_IN_PROGRESS => 'DELIVERY IN PROGRESS',
            $this->DELIVERY_CANCEL => 'DELIVERY CANCEL',
            $this->DELIVERY_COMPLETED => 'DELIVERY COMPLETED',
            $this->WAITING_FOR_PICKUP => 'WAITING FOR PICKUP'
        ];

        return $statusMap[$status] ?? 'UNKNOWN';
    }

    public function patientCount($pharmacyID)
    {
        $query = "SELECT COUNT(Distinct PatientID) AS patientCount FROM $this->table WHERE PharmacyID = ?";
        return $this->query($query, [$pharmacyID]);
    }

    public function orderCount($pharmacyID)
    {
        $query = "SELECT COUNT(DISTINCT OrderID) AS orderCount FROM $this->table WHERE PharmacyID = ?";
        return $this->query($query, [$pharmacyID]);
    }

    public function monthlyIncome($pharmacyID)
    {
        $query = "SELECT SUM(totalBill) AS currentBalance 
              FROM $this->table 
              WHERE PharmacyID = ? 
              AND date >= DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m-01') 
              AND date < DATE_FORMAT(CURDATE() + INTERVAL 1 MONTH, '%Y-%m-01')";

        return $this->query($query, [$pharmacyID]);
    }
}
