<?php

class MedicineOrder
{
    use Model;

    protected $table = 'medicineOrder';
    protected $allowedColumns = ['OrderID', 'date', 'status', 'pickup', 'destination', 'destinationLat', 'destinationLong', 'PatientID', 'PharmacyID', 'DeliveryID', 'prescription', 'paymentMethod'];
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
    private $DELIVERY_REJECTED = 'DR';
    private $DELIVERY_COMPLETED = 'WC';
    private $WAITING_FOR_PICKUP = 'WP';

    public function getOrderDetails()
    {
        $sql = "Select * FROM $this->table";
        return $this->query($sql);
    }

    public function getMedicineOrder($orderID)
    {
        return $this->first(['OrderId' => $orderID]);
    }

    public function checkPharmacyOrder($orderID, $pharmacyID)
    {
        $query = "SELECT * FROM $this->table WHERE OrderID = :OrderID AND PharmacyID = :PharmacyID";
        $data = ['OrderID' => $orderID, 'PharmacyID' => $pharmacyID];
        return $this->query($query, $data);
    }


    public function getOrdersByPatient($patientID)
    {
        $query = "SELECT * FROM $this->table WHERE PatientID = :patientID and OrderID in (select DISTINCT(OrderID) FROM OrderView WHERE PatientID = :patientID) order by date DESC";
        $data = ['patientID' => $patientID];
        if ($this->query($query, $data)) {
            return $this->query($query, $data);
        } else {
            return false;
        }
    }

    public function placeOrder($patientID, $pickup, $destination, $destinationLat, $destinationLong, $pharmacyID, $prescription)
    {
        $data = [
            'date' => date('Y-m-d H:i:s'),
            'status' => $this->WAITING,
            'pickup' => $pickup,
            'destination' => $destination,
            'destinationLat' => $destinationLat,
            'destinationLong' => $destinationLong,
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
        $data = ['status' => $status];
        $this->update($orderID, $data, 'OrderID');
    }

    public function setPaymentMethod($orderID, $paymentMethod)
    {
        $data = ['paymentMethod' => $paymentMethod];
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
            $this->ACCEPT_QUOTATION => 'ACCEPT QUOTATION',
            $this->DELIVERED => 'DELIVERED',
            $this->USER_PICKED_UP => 'USER PICKED UP',
            $this->REJECTED => 'REJECTED',
            $this->DELIVERY_FAILED => 'DELIVERY FAILED',
            $this->ACCEPTED => 'ACCEPTED',
            $this->WAITING_FOR_DRIVER => 'WAITING FOR DRIVER',
            $this->DELIVERY_IN_PROGRESS => 'DELIVERY IN PROGRESS',
            $this->DELIVERY_REJECTED => 'DELIVERY REJECTED',
            $this->DELIVERY_COMPLETED => 'DELIVERY COMPLETED',
            $this->WAITING_FOR_PICKUP => 'WAITING FOR PICKUP'
        ];

        return $statusMap[$status] ?? 'UNKNOWN';
    }

    public function getIncome($pharmacyId, $month, $year)
    {

        $query = "
            SELECT medicineOrder.orderId, medicineOrder.totalBill, medicineOrder.patientId, medicineOrder.date
            FROM medicineOrder
            WHERE PharmacyID = :pharmacyId
            AND MONTH(medicineOrder.date) = :Month
            AND YEAR(medicineOrder.date) = :Year;
        ";
        $data = [
            'pharmacyId' => $pharmacyId,
            'Month' => $month,
            'Year' => $year
        ];

        $income = $this->query($query, $data);

        //show($income);

        return $income;
    }

    public function getOrdersByPharmacy($pharmacyID)
    {
        $query = "SELECT * FROM $this->table WHERE PharmacyID = :PharmacyID ORDER BY date DESC";
        return $this->query($query, ['PharmacyID' => $pharmacyID]);
    }

    public function getPrescription($orderId)
    {
        $sql = "SELECT prescription FROM $this->table WHERE OrderID = :OrderID";
        $result = $this->query($sql, ['OrderID' => $orderId]);

        if (!empty($result)) {
            return 'uploads/prescriptions/' . $result[0]->prescription;
        }

        return null;
    }
}
