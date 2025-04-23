<?php

class InventoryMain
{
    use Controller;
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

        // $data['username'] = [];
        // $this->view('pharmacy/inventoryMain', $data);

        if (!isset($_SESSION['user_id'])) {
            redirect('login'); // or show an unauthorized message
            exit();
        }

        $pharmacyID = $_SESSION['user_id'];

        $inventoryModel = new StockInventoryDetails();
        $inventory = $inventoryModel->getInventoryByPharmacy($pharmacyID);


        $this->view('pharmacy/inventoryMain', ['inventories' => $inventory]);
    }
    // public function read()
    // {
    //     $inventoryModel = new StockInventoryDetails();
    //     $inventory = $inventoryModel->getInventoryDetails();

    //     // Pass the data to the view
    //     $this->View('pharmacy/inventoryrMain', ['inventories' => $inventory]);
    // }
    // add other methods like edit, update, delete, etc.
}
