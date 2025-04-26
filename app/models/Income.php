<?php

class Income
{
    use Model;

    protected $table = "medicineOrder";
    protected $allowedColumns = ['PharmacyID', 'totalBill', 'orderId'];
}
