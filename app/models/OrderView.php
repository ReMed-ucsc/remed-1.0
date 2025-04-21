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
    private $REJECTED = 'R';
    private $DELIVERY_FAILED = 'F';
    private $ACCEPTED = 'A';
    private $DELIVERY_IN_PROGRESS = 'I';
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
            $this->DELIVERY_IN_PROGRESS => 'DELIVERY IN PROGRESS',
            $this->DELIVERY_COMPLETED => 'DELIVERY COMPLETED',
            $this->WAITING_FOR_PICKUP => 'WAITING FOR PICKUP'
        ];

        return $statusMap[$status] ?? 'UNKNOWN';
    }
}
