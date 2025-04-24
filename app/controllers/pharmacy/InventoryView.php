<?php

class InventoryView
{
    use Controller;

    public function __construct()
    {
        $this->protectRoute();
    }

    public function index($inventoryId)
    {
        $inventoryModel = new StockInventoryDetails();
        $stock = new StockDataView();

        $inventory = $inventoryModel->getMedicineInventory($inventoryId);
        $inventoryList = $inventoryModel->getInventoryDetails($inventoryId);
        $historyList = $stock->getPurchaseHistory($inventoryId);

        //pass the data to the view
        $this->View('pharmacy/inventoryView', ['InventoryId' => $inventoryId, 'inventory' => $inventory, 'inventoryList' => $inventoryList, 'historyList' => $historyList]);
    }

    // public function read($inventoryId)
    // {
    //     $inventoryModel = new StockInventoryDetails();
    //     $inventory = $inventoryModel->getMedicineInventory($inventoryId);

    //     //pass the data to the view
    //     $this->View('pharmacy/inventoryView', ['inventoryID' => $inventoryId, 'inventory' => $inventory, 'viewOnly' => true]);
    // }

    public function edit($inventoryId)
    {
        $drug = new DrugInventory();

        $result = $drug->updateInventory(
            $inventoryId,
            $_POST['thresholdLimit'],
            $_POST['storageLocation'],
            $_POST['storageConditions'],
            $_POST['sellingPrice']
        );

        if ($result) {
            redirect('inventoryView/' . $inventoryId);
        } else {
            redirect('inventoryView/' . $inventoryId . '/fail');
        }
    }

    // add other methods like edit, update, delete, etc.
}
