<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';

//start processing
if (isset($_POST['CreateRegistration'])) {

    //save customer records
    $getcustomerdata = array(
        "UserFullName" => $_POST['UserFullName'],
        "UserPhoneNumber" => $_POST['UserPhoneNumber'],
        "UserEmailId" => $_POST['UserEmailId'],
        "UserStatus" => "1",
        "UserType" => "Customer",
        "UserCreatedAt" => RequestDataTypeDate(),
        "UserCompanyName" => $_POST['UserCompanyName'],
    );

    $SaveCustomers = INSERT("users", $getcustomerdata);
    if ($SaveCustomers == true) {
        $UserId = FETCH("SELECT * FROM users where UserPhoneNumber='" . $_POST['UserPhoneNumber'] . "' ORDER BY UserId DESC limit 1", "UserId");
        $Response = INSERT("user_addresses", [
            "UserAddressUserId" => FETCH("SELECT * FROM users where UserPhoneNumber='" . $_POST['UserPhoneNumber'] . "' ORDER BY UserId DESC limit 1", "UserId"),
            "UserStreetAddress" => SECURE($_POST['CustomerStreetAddress'], "e"),
            "UserLocality" => $_POST['CustomerAreaLocality'],
            "UserCity" => $_POST['CustomerCity'],
            "UserState" => $_POST['CustomerState'],
            "UserCountry" => $_POST['CustomerCountry'],
            "UserPincode" => $_POST['CustomerPincode'],
            "UserAddressType" => "BILLING"
        ]);
    } else {
        $UserId = null;
    }

    //save registration details
    $registration_ref_no = $_SESSION['REGISTRATION_NO'];

    $registrations = [
        "registration_ref_no" => $registration_ref_no,
        "registration_vendor_id" => LOGIN_UserId,
        "registration_user_id" => $UserId,
        "registration_created_at" => RequestDataTypeDate,
        "registration_status" => $_POST['WarrantyStatus'],
        "registration_file" => UPLOAD_FILES("../storage/reg/$registration_ref_no", "null", "reg", "file", "registration_file"),
    ];
    $save = INSERT("registrations", $registrations);
    $warranty_main_reg_id = FETCH("SELECT * FROM registrations WHERE registration_user_id='$UserId' ORDER BY registrations_id DESC limit 1", "registrations_id");

    //save warranty product details
    $WARRANTY_CUSTOM_ID =  WARRANTY_CUSTOM_ID;
    $WarrantyData = array(
        "WarrantyCustomerId" => $UserId,
        "WarrantyCustomId" => $WARRANTY_CUSTOM_ID,
        "WarrantyProductSno" => $_POST['WarrantyProductSno'],
        "WarrantyProductModalNo" => $_POST['WarrantyProductModalNo'],
        "WarrantyProductMfgDate" => $_POST['WarrantyProductMfgDate'],
        "WarrantyProductPurchasedate" => $_POST['WarrantyProductPurchasedate'],
        "WarrantyProductCapacity" => $_POST['WarrantyProductCapacity'],
        "WarrantyProductMonthWarranty" => $_POST['WarrantyProductMonthWarranty'],
        "WarrantyProductLife" => $_POST['WarrantyProductLife'],
        "WarrantyExpireDate" => $_POST['WarrantyExpireDate'],
        "WarrantyStatus" => $_POST['WarrantyStatus'],
        "WarrantyProductCreatedAt" => RequestDataTypeDate(),
        "WarrantyProductUpdatedAt" => RequestDataTypeDate,
        "WarrantyProductCreatedBy" => LOGIN_UserId,
        "warranty_main_reg_id" => $warranty_main_reg_id
    );
    $Check = CHECK("SELECT * FROM warranty_products where WarrantyProductSno='" . $_POST['WarrantyProductSno'] . "'");
    if ($Check != true) {
        $Save = INSERT("warranty_products", $WarrantyData);
        $Msg = "Unable To Save Warranty Details at the moment!";
        $Exits = false;
    } else {
        $Save = false;
        $Msg = "Warranty Details Already saved into system for Serial No. <b>" . $_POST['WarrantyProductSno'] . "</b>";
        $Exits = true;
    }

    unset($_SESSION['REGISTRATION_NO']);

    RESPONSE($Save, "Warranty Details saved for future references", "$Msg");
}
