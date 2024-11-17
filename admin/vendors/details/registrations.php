<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Regsitrations";
$PageDescription = "Manage all customers";

if (isset($_GET['uid'])) {
  $_SESSION['REQ_UserId'] = SECURE($_GET['uid'], "d");
  $REQ_UserId = $_SESSION['REQ_UserId'];
} else {
  $REQ_UserId = $_SESSION['REQ_UserId'];
}

$PageSqls = "SELECT * FROM users where UserId='$REQ_UserId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("profile").classList.add("active");
      document.getElementById("profile_view").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/admin/loader.php"; ?>

    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-3">
                      <?php include "c-profile.php"; ?>
                    </div>
                    <div class="col-md-9">
                      <div class="row">
                        <div class="col-md-12 mb-2">
                          <div class="flex-s-b">
                            <a href="../index.php" class="btn btn-sm btn-default mr-1 back-btn"><i class="fa fa-angle-left"></i></a>
                            <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?></h4>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <?php include "common-nav.php"; ?>
                        </div>
                      </div>

                      <div class='row mt-2'>
                        <div class="col-md-3 col-xs-6 col-12">
                          <div class="card">
                            <div class='card-body bg-info'>
                              <h1 class="mb-0"><?php echo TOTAL("SELECT * FROM registrations where registration_vendor_id='$REQ_UserId'"); ?></h1>
                              <p>All Registration</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-3 col-xs-6 col-12">
                          <div class="card">
                            <div class='card-body bg-success'>
                              <h1 class="mb-0"><?php echo TOTAL("SELECT * FROM registrations where registration_status='Active' and registration_vendor_id='$REQ_UserId'"); ?></h1>
                              <p>All Active Registration</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-3 col-xs-6 col-12">
                          <div class="card">
                            <div class='card-body bg-danger'>
                              <h1 class="mb-0"><?php echo TOTAL("SELECT * FROM registrations where registration_status='Expired' and registration_vendor_id='$REQ_UserId'"); ?></h1>
                              <p>All Expired Registration</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-3 col-xs-6 col-12">
                          <div class="card">
                            <div class='card-body bg-primary'>
                              <h1 class="mb-0">
                                Rs.<?php
                                    $GetCurrentModalOfferNo = FETCH("SELECT * FROM offers, offer_credits where offers.OfferId=offer_credits.offer_credit_id and OfferStatus='Active'", "offer_on_modal_no");
                                    $offer_credit_amount = FETCH("SELECT * FROM offers, offer_credits where offers.OfferId=offer_credits.offer_credit_id and OfferStatus='Active'", "offer_credit_amount");
                                    $GetNoOfReg = TOTAL("SELECT * FROM warranty_products, registrations where registrations.registrations_id=warranty_products.warranty_main_reg_id and  WarrantyProductModalNo like '%$GetCurrentModalOfferNo%' and registration_vendor_id='" . $REQ_UserId . "'");

                                    echo $GetNoOfReg * $offer_credit_amount;
                                    ?>
                              </h1>
                              <p>Offer Credits</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <form class='row'>
                        <div class='col-md-3'>
                          <input type='search' onchange="form.submit()" placeholder="Customer name" name='CustomerName' value='<?php echo IfRequested("GET", "CustomerName", "", false); ?>' class="form-control">
                        </div>
                        <div class='col-md-3'>
                          <input type='search' onchange="form.submit()" placeholder="Phone Number" name='CustomerPhoneNumber' value='<?php echo IfRequested("GET", "CustomerPhoneNumber", "", false); ?>' class="form-control">
                        </div>
                        <div class='col-md-3'>
                          <input type='search' onchange="form.submit()" placeholder="Serial No" value='<?php echo IfRequested('GET', "SerialNo", "", false); ?>' name='SerialNo' class="form-control">
                        </div>
                        <div class='col-md-3'>
                          <input type='month' onchange="form.submit()" value='<?php echo IfRequested("GET", "ExpiringMonth", date("Y-m"), false); ?>' name='ExpiringMonth' class="form-control">
                        </div>
                      </form>

                      <div class='row'>
                        <?php
                        $AllRegistrations = FetchConvertIntoArray("SELECT * FROM users, registrations, warranty_products where users.UserId=registrations.registration_user_id and registrations.registrations_id=warranty_products.warranty_main_reg_id and registrations.registration_vendor_id='" . $REQ_UserId . "' GROUP BY warranty_main_reg_id ORDER BY date(WarrantyExpireDate) DESC", true);
                        if ($AllRegistrations == null) {
                          NoData("No Registration are found for current month!");
                        } else {
                          foreach ($AllRegistrations as $Registration) {
                            $UserSql = "SELECT * FROM users where UserId='" . $Registration->registration_user_id . "'";
                            $ProductSql = "SELECT * FROM warranty_products where warranty_main_reg_id='" . $Registration->registrations_id . "'";
                        ?>
                            <div class='col-md-4 col-sm-6'>
                              <div class='card'>
                                <div class='card-body bg-light box1'>
                                  <div>
                                    <h5 class='mb-0'><i class='fa fa-user text-success h5'></i> <?php echo FETCH($UserSql, "UserFullName"); ?></h5>
                                    <p>
                                      <span><i class='fa fa-phone text-info'></i> <?php echo FETCH($UserSql, "UserPhoneNumber"); ?></span><br>
                                      <span>
                                        <span><b>Modal No :</b> <?php echo FETCH($ProductSql, "WarrantyProductModalNo"); ?></span><br>
                                        <span><b>Serial No :</b> <?php echo FETCH($ProductSql, "WarrantyProductSno"); ?></span><br>
                                        <span><b>Reg Date :</b> <?php echo DATE_FORMATE2("d M, Y", $Registration->registration_created_at); ?></span><br>
                                        <span><b>Warranty Status :</b> <?php echo WarrantyStatus($Registration->WarrantyStatus); ?></span><br>
                                        <span><b>Expire Date :</b> <?php echo DATE_FORMATE2("d M, Y", $Registration->WarrantyExpireDate); ?></span><br>
                                      </span>
                                    </p>
                                    <hr>
                                    <a target="_blank" href="<?php echo $Dir; ?>/edoc/warranty.php?warrantyid=<?php echo $Registration->WarrantyProductsId; ?>" class='btn btn-sm btn-success'>View Warranty Card</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php
                          }
                        } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>