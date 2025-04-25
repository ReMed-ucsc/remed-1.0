<?php

class InventoryRefill
{
    use Controller;
    public function index($inventoryId)
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


        $inventoryModel = new StockInventoryDetails();
        $stock = new StockDataView();

        if ($inventoryModel->checkPharmacyInventory($inventoryId, $_SESSION['user_id']) == false) {
            redirect("inventoryMain");
            exit;
        }

        $inventory = $inventoryModel->getMedicineInventory($inventoryId);
        $inventoryList = $inventoryModel->getInventoryDetails($inventoryId);
        $historyList = $stock->getPurchaseHistory($inventoryId);

        //pass the data to the view
        $this->View('pharmacy/inventoryRefill', ['InventoryId' => $inventoryId, 'inventory' => $inventory, 'inventoryList' => $inventoryList, 'historyList' => $historyList]);
    }

    public function addStock($inventoryId)
    {
        var_dump($_POST);
        $stockModel = new StockDataView();

        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['InventoryId']) {
            $data = [
                'InventoryId'        => $_POST['InventoryId'],
                'batchId'            => $_POST['batchID'] ?? '',
                'stockQuantity'      => $_POST['stockQuantity'] ?? '',
                // 'thresholdLimit'     => $_POST['thresholdLimit'] ?? '',
                // 'storageLocation'    => $_POST['storageLocation'] ?? '',
                'manufacturingDate'  => $_POST['manufacturingDate'] ?? '',
                'expiryDate'         => $_POST['expiryDate'] ?? '',
                'purchaseDate'       => $_POST['purchaseDate'] ?? '',
                // 'storageConditions'  => $_POST['storageCondition'] ?? '',
                'purchaseCost'       => $_POST['purchasePrice'] ?? '',
                'sellingPrice'       => $_POST['sellingPrice'] ?? ''
            ];

            if ($inventoryId) {
                $stockID = $stockModel->addStock(
                    $inventoryId,
                    $data['stockQuantity'],
                    $data['manufacturingDate'],
                    $data['expiryDate'],
                    $data['purchaseCost'],
                    $data['purchaseDate'], // purchaseDate (current date)
                    $data['batchId']
                );

                if ($stockID) {
                    redirect('inventoryView/' . $inventoryId);
                    exit;
                }
            }
        }
        redirect('inventoryView/' . $inventoryId);
    }

    // add other methods like edit, update, delete, etc.
}
