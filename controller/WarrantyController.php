<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';

if (isset($_POST['CreateWarrantyCard'])) {
    $WarrantyData = array(
        "WarrantyCustomerId" => SECURE($_POST['WarrantyCustomerId'], "d"),
        "WarrantyCustomId" => $_POST['WarrantyCustomId'],
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
        "WarrantyProductCreatedBy" => LOGIN_UserId
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

    if ($Save == true) {

        $_SESSION['WARRANTY_SERIAL_NO'] = $_POST['WarrantyProductSno'];
    } else {
        if ($Exits == true) {
            $_SESSION['WARRANTY_SERIAL_NO'] = $_POST['WarrantyProductSno'];
        } else {
            $access_url = $access_url;
        }
    }

    RESPONSE($Save, "Warranty Details saved for future references", "$Msg");

    //update warranty_products
} elseif (isset($_POST['UpdateWarrantyCard'])) {
    $WarrantyProductsId = SECURE($_POST['WarrantyProductsId'], "d");

    $WarrantyData = array(
        "WarrantyCustomerId" => SECURE($_POST['WarrantyCustomerId'], "d"),
        "WarrantyCustomId" => $_POST['WarrantyCustomId'],
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
        "WarrantyProductCreatedBy" => LOGIN_UserId
    );

    $Check = CHECK("SELECT * FROM warranty_products where WarrantyProductSno='" . $_POST['WarrantyProductSno'] . "'");
    if ($Check == true) {
        $Save = UPDATE_DATA("warranty_products", $WarrantyData, "WarrantyProductsId='$WarrantyProductsId'");
        $Msg = "Product Details updated successfully";
        $Exits = false;
    } else {
        $Save = INSERT("warranty_products", $WarrantyData);
        $Msg = "Warranty Details saved into system for Serial No. <b>" . $_POST['WarrantyProductSno'] . "</b>";
        $Exits = true;
    }

    RESPONSE($Save, "Warranty Details saved for future references", "$Msg");

    //warranty upgrade request
} elseif (isset($_POST['SendWarrantyUpgradeRequest'])) {
    $warranty_card_id = SECURE($_POST['warranty_card_id'], "d");
    $warranty_upgrade_customer_id = SECURE($_POST['warranty_upgrade_customer_id'], "d");
    $warranty_upgrade_vendor_id = SECURE($_POST['warranty_upgrade_vendor_id'], "d");

    $warranty_upgrade_requests = [
        "warranty_card_id" => $warranty_card_id,
        "warranty_upgrade_vendor_id" => LOGIN_UserId,
        "warranty_upgrade_customer_id" => $warranty_upgrade_customer_id,
        "warranty_upgrade_current_expire_date" => $_POST['warranty_upgrade_current_expire_date'],
        "warranty_upgrade_request_date" => $_POST['warranty_upgrade_request_date'],
        "warranty_upgrade_request_sent_at" => RequestDataTypeDate,
        "warranty_upgrade_status" => "NEW",
        "warranty_upgrade_notes" => "",
    ];
    $Response = INSERT("warranty_upgrade_requests", $warranty_upgrade_requests);
    RESPONSE($Response, "Warranty Upgrade request sent successfully!", "Unable to send warranty upgrade requests.");

    //update warranty upgrade status
} elseif (isset($_POST['UpdateWarrantyUpgradeRequest'])) {
    $warranty_upgrade_id = SECURE($_POST['warranty_upgrade_id'], "d");

    $warranty_upgrade_requests = [
        "warranty_upgrade_request_date" => $_POST['warranty_upgrade_request_date'],
        "warranty_upgrade_notes" => SECURE($_POST['warranty_upgrade_notes'], "e"),
        "warranty_upgrade_status" => $_POST['warranty_upgrade_status']
    ];
    $Response = UPDATE_DATA("warranty_upgrade_requests", $warranty_upgrade_requests, "warranty_upgrade_id='$warranty_upgrade_id'");

    if ($_POST['warranty_upgrade_status'] == "Approve") {
        $WarrantyCardId = FETCH("SELECT * FROM warranty_upgrade_requests where warranty_upgrade_id='$warranty_upgrade_id'", "warranty_card_id");
        $UPDATE = UPDATE("UPDATE warranty_products SET WarrantyExpireDate='" . $_POST['warranty_upgrade_request_date'] . "' where WarrantyProductsId='$WarrantyCardId'");
    }

    RESPONSE($Response, "Warranty Upgrade request is " . $_POST['warranty_upgrade_status'] . "!", "Unable to update Wrranty card");
}
