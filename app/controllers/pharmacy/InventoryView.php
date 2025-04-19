<?php

class InventoryView
{
    use Controller;
    public function index($inventoryId)
    {
        $inventoryModel = new StockInventoryDetails();
        $inventory = $inventoryModel->getMedicineInventory($inventoryId);

        //pass the data to the view
        $this->View('pharmacy/inventoryView', ['InventoryId' => $inventoryId, 'inventory' => $inventory]);
    }

    public function read($inventoryId)
    {
        $inventoryModel = new StockInventoryDetails();
        $inventory = $inventoryModel->getMedicineInventory($inventoryId);

        //pass the data to the view
        $this->View('pharmacy/inventoryView', ['inventoryID' => $inventoryId, 'inventory' => $inventory, 'viewOnly' => true]);
    }

    public function edit($inventoryId)
    {
        $inventoryModel = new StockInventoryDetails();
    }

    // add other methods like edit, update, delete, etc.
}
