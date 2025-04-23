<?php

class InventoryCreate
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

        $data['username'] = [];
        $this->view('pharmacy/inventoryCreate', $data);
    }

    public function Create() {}

    public function addItem()
    {
        $stock = new StockDataView();
        $drug = new DrugInventory();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {



            $data = [
                'productName'        => $_POST['productName'],
                'manufacturer'       => $_POST['manufacturer'],
                'genericName'        => $_POST['genericName'],
                'category'           => $_POST['category'],
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

            $ChangedInventoryId = $drug->addDrug(

                $data['thresholdLimit'],
                $data['storageLocation'],
                $data['storageConditions'],
                $data['sellingPrice']
            );

            // Call to add stock and drug information
            $stock->addStock(
                $ChangedInventoryId,
                $data['stockQuantity'],
                $data['manufacturingDate'],
                $data['expiryDate'],
                $data['purchaseCost'],
                $data['purchaseDate'], // purchaseDate (current date)
                $data['batchId']
            );
            $this->view('pharmacy/InventoryCreate', ['inventoryForm' => $data]);
        }
    }

    // public function addItem()
    // {
    //     $stock = new StockDataView();
    //     $drug = new DrugInventory();

    //     if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //         // Clean up variable naming for consistency
    //         $productName         = $data['ProductName'] ?? '';  // Fixing typo from 'ProducteName'
    //         $manufacturer        = $data['Manufacturer'] ?? '';
    //         $genericName         = $data['genericName'] ?? '';
    //         $category            = $data['category'] ?? '';
    //         $batchNumber         = $data['batchNumber'] ?? '';
    //         $latestStockQuantity = $data['LatestStockQuantity'] ?? '';  // Consistent naming
    //         $thresholdLimit      = $data['thresholdLimit'] ?? '';
    //         $storageLocation     = $data['storageLocation'] ?? '';
    //         $manufacturingDate   = $data['manufacturingDate'] ?? '';
    //         $expiryDate          = $data['expiryDate'] ?? '';
    //         $storageConditions   = $data['storageConditions'] ?? '';
    //         $purchaseCost        = $data['purchaseCost'] ?? '';
    //         $sellingPrice        = $data['sellingPrice'] ?? '';

    //         $data = [
    //             'productName'        => $_POST['productName'] ?? $productName,
    //             'manufacturer'       => $_POST['manufacturer'] ?? $manufacturer,
    //             'genericName'        => $_POST['genericName'] ?? $genericName,
    //             'category'           => $_POST['category'] ?? $category,
    //             'batchId'            => $_POST['batchID'] ?? $batchNumber,
    //             'stockQuantity'      => $_POST['stockQuantity'] ?? $latestStockQuantity,
    //             'thresholdLimit'     => $_POST['thresholdLimit'] ?? $thresholdLimit,
    //             'storageLocation'    => $_POST['storageLocation'] ?? $storageLocation,
    //             'manufacturingDate'  => $_POST['manufacturingDate'] ?? $manufacturingDate,
    //             'expiryDate'         => $_POST['expiryDate'] ?? $expiryDate,
    //             'purchaseDate'       => $_POST['purchaseDate'] ?? '',
    //             'storageConditions'  => $_POST['storageConditions'] ?? $storageConditions,
    //             'purchaseCost'       => $_POST['purchaseCost'] ?? $purchaseCost,
    //             'sellingPrice'       => $_POST['sellingPrice'] ?? $sellingPrice
    //         ];

    //         $ChangedInventoryId = $drug->addDrug(

    //             $data['thresholdLimit'],
    //             $data['storageLocation'],
    //             $data['storageConditions'],
    //             $data['sellingPrice']
    //         );

    //         // Call to add stock and drug information
    //         $stock->addStock(
    //             $ChangedInventoryId,
    //             $data['stockQuantity'],
    //             $data['manufacturingDate'],
    //             $data['expiryDate'],
    //             $data['purchaseCost'],
    //             $data['purchaseDate'], // purchaseDate (current date)
    //             $data['batchId']
    //         );



    //         // Return the view with updated data
    //         $this->view('pharmacy/InventoryCreate', ['inventoryForm' => $data]);
    //     }
    // }


    // add other methods like edit, update, delete, etc.
}
