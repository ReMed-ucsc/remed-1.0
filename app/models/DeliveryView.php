<?php

class DeliveryView
{
    use Model;

    protected $table = 'DeliveryView';
    protected $allowed = ['DeliveryID', 'OrderID', 'DriverID', 'PharmacyID', 'PatientID'];

    
}