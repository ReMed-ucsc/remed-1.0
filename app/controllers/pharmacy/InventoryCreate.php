<?php

class InventoryCreate
{
    use Controller;

    public function __construct()
    {
        $this->protectRoute();
    }

    public function index()
    {
        // $user = new User;
        // $arr['email'] = "name@example.com";

        // $result = $model->where(data_for_filtering, data_not_for_filtering);
        // $result = $model->insert(insert_data);
        // $result = $model->update(filtering_data updating_data, id_column_for_filtering);
        // $result = $model->delete(id, id_column);
        // $result = $user->findAll();

        // show($result);

        // $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $data['username'] = [];
        $this->view('pharmacy/inventoryCreate', $data);
    }

    public function addItem()
    {
        $inventoryModel = new StockInventoryDetails();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $data = [
                'ProducteName'        => $_POST['ProducteName'],
                'Manufacturer'       => $_POST['Manufacturer'],
                'genericName'        => $_POST['genericName'],
                'category'           => $_POST['category'],
                'batchNumber'        => $_POST['batchNumber'],
                'LatestStockQuantity' => $_POST['LatestStockQuantity'],
                'thresholdLimit'     => $_POST['thresholdLimit'],
                'storageLocation'    => $_POST['storageLocation'],
                'manufacturingDate'  => $_POST['manufacturingDate'],
                'expiryDate'         => $_POST['expiryDate'],
                'storageConditions'  => $_POST['storageConditions'],
                'purchaseCost'       => $_POST['purchaseCost'],
                'sellingPrice'       => $_POST['sellingPrice']
            ];

            $inventoryModel->addInventory($data);
            // redirect('pharmacy/inventoryCreate');
        }

        $this->view('pharmacy/InventoryCreate', ['inventory' => $inventoryModel]);
    }


    // add other methods like edit, update, delete, etc.
}
