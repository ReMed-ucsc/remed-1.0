<?php

class InventoryMain
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

    public function Create() {}

    public function addItem()
    {
        $stock = new StockDataView();
        $drug = new DrugInventory();
        $pharmacyId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['productId']) {



            $data = [
                'productId'        => $_POST['productId'],
                'batchId'            => $_POST['batchID'] ?? '',
                'stockQuantity'      => $_POST['stockQuantity'] ?? '',
                'thresholdLimit'     => $_POST['thresholdLimit'] ?? '',
                'storageLocation'    => $_POST['storageLocation'] ?? '',
                'manufacturingDate'  => $_POST['manufacturingDate'] ?? '',
                'expiryDate'         => $_POST['expiryDate'] ?? '',
                'purchaseDate'       => $_POST['purchaseDate'] ?? '',
                'storageConditions'  => $_POST['storageCondition'] ?? '',
                'purchaseCost'       => $_POST['purchasePrice'],
                'sellingPrice'       => $_POST['sellingPrice'] ?? ''
            ];

            $InventoryId = $drug->addDrug(
                $data['productId'],
                $pharmacyId,
                $data['stockQuantity'],
                $data['thresholdLimit'],
                $data['storageLocation'],
                $data['storageConditions'],
                $data['sellingPrice']
            );

            // Call to add stock and drug information
            if ($InventoryId) {
                $stockID = $stock->addStock(
                    $InventoryId,
                    $data['stockQuantity'],
                    $data['manufacturingDate'],
                    $data['expiryDate'],
                    $data['purchaseCost'],
                    $data['purchaseDate'], // purchaseDate (current date)
                    $data['batchId']
                );

                if ($stockID) {
                    redirect('inventoryView/' . $InventoryId);
                    exit;
                }
            }
        }
        redirect('inventoryCreate');
    }
}
