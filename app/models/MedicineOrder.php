<?php

class MedicineOrder
{
    use Model;

    protected $table = 'medicineOrder';
    protected $allowedColumns = ['OrderID', 'date', 'status', 'pickup', 'destination', 'PatientID', 'PharmacyID', 'DeliveryID'];
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

    public function getMedicineOrder($orderID)
    {
        return $this->first(['OrderID' => $orderID]);
    }


    public function getOrdersByPatient($patientID)
    {
        $query = "SELECT * FROM $this->table WHERE PatientID = :patientID";
        $data = ['patientID' => $patientID];
        return $this->query($query, $data);
    }

    public function placeOrder($patientID, $pickup, $destination, $pharmacyID, $deliveryID = 0)
    {
        $data = [
            'date' => date('Y-m-d H:i:s'),
            'status' => $this->WAITING,
            'pickup' => $pickup,
            'destination' => $destination,
            'PatientID' => $patientID,
            'PharmacyID' => $pharmacyID,
            'DeliveryID' => $deliveryID // unnassigned => 0

        ];
        return $this->insert($data);
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
}
