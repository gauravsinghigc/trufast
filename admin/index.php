<?php
$Dir = "..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Dashboard";
$PageDescription = "Main Dashboard of " . APP_NAME . " for Highlighted and latest checkups about available data";

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
      document.getElementById("dashboard").classList.add("active");
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
                <?php
                if (LOGIN_UserType == "VENDOR") { ?>
                  <div class='card-body'>
                    <?php include $Dir . "/include/admin/slider.php"; ?>
                    <div class='row'>
                      <div class="col-md-12">
                        <h1 class="p-2">My Dashboard</h1>
                      </div>
                      <div class="col-md-3 col-xs-6 col-12">
                        <div class="card">
                          <div class='card-body bg-info'>
                            <h1 class="mb-0"><?php echo TOTAL("SELECT * FROM registrations"); ?></h1>
                            <p>All Registration</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3 col-xs-6 col-12">
                        <div class="card">
                          <div class='card-body bg-success'>
                            <h1 class="mb-0"><?php echo TOTAL("SELECT * FROM registrations where registration_status='Active'"); ?></h1>
                            <p>All Active Registration</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3 col-xs-6 col-12">
                        <div class="card">
                          <div class='card-body bg-danger'>
                            <h1 class="mb-0"><?php echo TOTAL("SELECT * FROM registrations where registration_status='Expired'"); ?></h1>
                            <p>All Expired Registration</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-6 col-12">
                        <div class="card">
                          <div class='card-body bg-warning'>
                            <h1 class="mb-0">
                              <?php $Registrations = TOTAL("SELECT * FROM registrations");
                              $Points = FETCH("SELECT * FROM rewards where RewardStatus='Active' order by RewardId DESC limit 1", "RewardApplicableOnlyFor");
                              if ($Points == null || $Points == 0) {
                                $Points = 1;
                              }
                              echo $Registrations * $Points; ?>
                            </h1>
                            <p>Earn Reward Points</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-6 col-12">
                        <div class="card">
                          <div class='card-body bg-primary'>
                            <h1 class="mb-0">
                              Rs.<?php
                                  $OffersCredits = 0;
                                  $GetCurrentModalOfferNo = FETCH("SELECT * FROM offers, offer_credits where offers.OfferId=offer_credits.offer_credit_id and OfferStatus='Active'", "offer_on_modal_no");
                                  $offer_credit_amount = FETCH("SELECT * FROM offers, offer_credits where offers.OfferId=offer_credits.offer_credit_id and OfferStatus='Active'", "offer_credit_amount");
                                  $GetNoOfReg = TOTAL("SELECT * FROM warranty_products, registrations where registrations.registrations_id=warranty_products.warranty_main_reg_id and WarrantyProductModalNo like '%$GetCurrentModalOfferNo%' and registration_vendor_id='" . LOGIN_UserId . "'");

                                  echo $GetNoOfReg * $offer_credit_amount;
                                  ?>
                            </h1>
                            <p>Offer Credits</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                } else { ?>
                  <div class="card-body">
                    <?php include $Dir . "/include/admin/slider.php"; ?>
                    <div class="row">
                      <div class="col-md-12">
                        <h3><b>Dashboard</b></h3>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6 col-md-3 text-center">
                        <div class="bg-secondary text-white" style="border-radius:0.5rem;">
                          <div class="mb-2 rounded-2 p-3">
                            <a class="text-white" href="complaints/index.php">
                              <h1>
                                <?PHP
                                if (LOGIN_UserType == "Admin") {
                                  echo TOTAL("SELECT * FROM complaints where ComplaintStatus like '%EXECUTIVE ASSIGNED%'");
                                } else {
                                  echo TOTAL("SELECT * FROM complaints where ComplaintAssignedTo='" . LOGIN_UserId . "' and ComplaintStatus like '%EXECUTIVE ASSIGNED%'");
                                } ?>
                              </h1>
                              OPEN COMPLAINTS
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="col-6 text-white col-md-3 text-center">
                        <div style="background-color:skyblue !important;border-radius:0.5rem;">
                          <div class="mb-2 rounded-2 p-3">
                            <a class="text-white" href="complaints/index.php?type=NEW COMPLAINT">
                              <h1>
                                <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintStatus like '%NEW COMPLAINT%'"); ?>
                              </h1>
                              NEW COMPLAINTS
                            </a>
                          </div>
                        </div>
                      </div>

                      <div class="col-6 text-white col-md-3 text-center">
                        <div class="bg-info" style="border-radius:0.5rem;">
                          <div class="mb-2 rounded-2 p-3">
                            <a class="text-white" href="complaints/index.php?type=IN PROGRESS">
                              <h1>
                                <?PHP

                                echo TOTAL("SELECT * FROM complaints where ComplaintStatus like '%IN PROGRESS%'");
                                ?>
                              </h1>
                              IN PROGRESS
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="col-6 text-white col-md-3 text-center rounded-3">
                        <div class="bg-success rounded-2" style="border-radius:0.5rem;">
                          <div class="mb-2 rounded-3 p-3">
                            <a class="text-white" href="complaints/index.php?type=COMPLETED">
                              <h1>
                                <?PHP

                                echo TOTAL("SELECT * FROM complaints where ComplaintStatus like '%COMPLETED%'");
                                ?>
                              </h1>
                              COMPLETED
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="">
                      <form class="w-100 flex-s-b">
                        <div class='w-50 m-r-10'>
                          <input type="search" placeholder="Complaint No: COMPLAINT-NO-15-OCT-2022-6884985" value="<?php echo IfRequested("GET", "ComplaintsCustomRefId", "", false); ?>" list="ComplaintsCustomRefId" name="ComplaintsCustomRefId" class="form-control" onchange="form.submit()">
                          <?php SUGGEST("complaints", "ComplaintsCustomRefId", "ASC"); ?>
                        </div>
                        <div class='w-50 ml-2'>
                          <input type="search" placeholder="Serial No" value="<?php echo IfRequested("GET", "ComplaintProductId", "", false); ?>" list="ComplaintProductSerialNo" name="ComplaintProductId" class="form-control" onchange="form.submit()">
                          <?php SUGGEST("complaint_products", "ComplaintProductSerialNo", "ASC"); ?>
                        </div>
                        <div class="w-25 ml-2">
                          <?php if (isset($_GET['type']) or isset($_GET['ComplaintsCustomRefId']) or isset($_GET['ComplaintProductId'])) { ?>
                            <a href="index.php" class="btn btn-md btn-danger"><i class="fa fa-times"></i> Clear Filter</a>
                          <?php } ?>
                        </div>
                      </form>
                      <div class="row">
                        <div class="col-md-12">
                          <h6 class="app-sub-heading">Complaints</h6>
                        </div>
                        <?php
                        if (isset($_GET['type'])) {
                          $type = $_GET['type'];
                          $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintStatus like '%$type%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
                        } elseif (isset($_GET['ComplaintsCustomRefId'])) {
                          $ComplaintsCustomRefId = $_GET['ComplaintsCustomRefId'];
                          $ComplaintProductId = $_GET['ComplaintProductId'];
                          $Complaints = FetchConvertIntoArray("SELECT * FROM complaints, complaint_products where complaints.ComplaintsId=complaint_products.MainComplaintId and ComplaintProductSerialNo like '%$ComplaintProductId%' and ComplaintsCustomRefId like '%$ComplaintsCustomRefId%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
                        } else {
                          $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintStatus like '%EXECUTIVE ASSIGNED%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
                        }

                        if ($Complaints == null) {
                          NoDataTableView("No Complaints Found!", 7);
                        } else {
                          $sNO = 0;
                          foreach ($Complaints as $Complaint) {
                            $sNO++; ?>
                            <div class="col-md-4 col-sm-6 col-12">
                              <a href="complaints/details/?id=<?php echo $Complaint->ComplaintsId; ?>">
                                <p class="data-list" style="height:7rem !important;">
                                  <small class="text-grey italic"><?php echo DATE_FORMATE2("d M, Y", $Complaint->ComplaintCreatedAt); ?></small>
                                  <span>
                                    <span class="pull-right">
                                      <span class="btn btn-xs btn-default"><?php echo $Complaint->ComplaintStatus; ?></span><br>
                                      <span class="text-grey">Complaint No</span><br>
                                      <span class="bold">
                                        <?php echo $Complaint->ComplaintsCustomRefId; ?>
                                      </span>
                                    </span>
                                  </span><br>
                                  <span>
                                    <span class="text-grey">Customer Details</span><br>
                                    <span class="bold">
                                      <a href="complaints/details/?id=<?php echo $Complaint->ComplaintsId; ?>"><i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserFullName"); ?></a>
                                      <br> <?php echo $Complaint->ComplaintAddress; ?>
                                    </span>
                                  </span>
                                </p>
                              </a>
                            </div>
                        <?php }
                        } ?>
                      </div>

                    </div>
                  </div>
                <?php } ?>
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