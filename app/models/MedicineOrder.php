<?php

class MedicineOrder
{
    use Model;

    protected $table = 'medicineOrder';
    protected $allowedColumns = ['OrderID', 'date', 'status', 'pickup', 'destination', 'PatientID', 'PharmacyID', 'DeliveryID', 'prescription'];
    protected $order_column = "OrderID";

    // order status categories
    private $WAITING = 'W';
    private $PROCESSING = 'P';
    private $DELIVERED = 'D';
    private $USER_PICKED_UP = 'U';
    private $CANCELED = 'C';
    private $REJECTED = 'R';
    private $PICKED_UP = 'P';
    private $DELIVERY_FAILED = 'F';

    public function getOrderDetails()
    {
        $sql = "Select * FROM $this->table";
        return $this->query($sql);
    }

    public function getMedicineOrder($orderID)
    {
        return $this->first(['OrderId' => $orderID]);
    }


    public function getOrdersByPatient($patientID)
    {
        $query = "SELECT * FROM $this->table WHERE PatientID = :patientID and OrderID in (select DISTINCT(OrderID) FROM OrderView WHERE PatientID = :patientID) order by date DESC";
        $data = ['patientID' => $patientID];
        return $this->query($query, $data);
    }

    public function placeOrder($patientID, $pickup, $destination, $pharmacyID, $prescription)
    {
        $data = [
            'date' => date('Y-m-d H:i:s'),
            'status' => $this->WAITING,
            'pickup' => $pickup,
            'destination' => $destination,
            'PatientID' => $patientID,
            'PharmacyID' => $pharmacyID,
            'DeliveryID' => 0, // unassigned
            'prescription' => $prescription
        ];
        $success = $this->insert($data);

        // If the insertion was successful, retrieve the last inserted ID
        if ($success) {
            return $this->lastInsertId();
        }

        // Return false if the insertion failed
        return false;
    }

    public function updateOrderStatus($orderID, $status)
    {
        $data = ['status' => $this->$status];
        $this->update($orderID, $data, 'OrderID');
    }

    public function assignDelivery($deliveryID, $orderID)
    {
        $data = ['DeliveryID' => $deliveryID];
        $this->update($orderID, $data, 'OrderID');
    }


    public function getStatusName($status)
    {
        $statusMap = [
            $this->WAITING => 'WAITING',
            $this->PROCESSING => 'PROCESSING',
            $this->DELIVERED => 'DELIVERED',
            $this->USER_PICKED_UP => 'USER_PICKED_UP',
            $this->CANCELED => 'CANCELED',
            $this->REJECTED => 'REJECTED',
            $this->PICKED_UP => 'PICKED_UP',
            $this->DELIVERY_FAILED => 'DELIVERY_FAILED'
        ];

        return $statusMap[$status] ?? 'UNKNOWN';
    }
}
