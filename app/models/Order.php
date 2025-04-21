<?php

require_once BASE_PATH . '/api/coontrollers/utilis/DeliveryUtility.php';

class Order
{
    use Model;

    protected $table = 'medicineOrder';
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

    public function confirmOrder($orderId)
    {
        $orderModel = new MedicineOrder();
        $utilityModel = new DeliveryUility();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $orderId = $_POST['orderId'];
            $status = 'W';

            $status = $orderModel->getStatusName('Q');

            $orderModel->updateOrderStatus($orderId, $status);

            //add the logic to only execute if the order is to be delivered
            //check if the order is store pickup
            $utilityModel->sendDetailstoDriver($orderId);

            //redirect to all orderes viewwing page 
            //change to appropiate redirection
            redirect("orderMain");
            exit;
        }

        //redirect("orderMain");
    }
}
