<?php

require_once BASE_PATH . '/api/controllers/utilis/DeliveryUtility.php';

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
            $status = 'WP';

            //$status = 'WAITING_FOR_PICKUP';

            $orderModel->updateOrderStatus($orderId, $status);

            //show($status);

            //add the logic to only execute if the order is to be delivered
            //check if the order is store pickup
            $utilityModel->sendDetailstoDriver($orderId);

            //redirect to all orderes viewwing page 
            //change to appropiate redirection
            //redirect("order/updateOrderStatus/$orderId/WD");
            exit;
        }

        redirect("order/updateOrderStatus/$orderId/WD");
    }
}
