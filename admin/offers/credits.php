<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Offers Credits";
$PageDescription = "Manage offers";
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
      document.getElementById("teams").classList.add("active");
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
                    <div class="col-md-12">
                      <a href="../index.php" class="btn btn-sm btn-default m-1"><i class="fa fa-angle-left"></i> Back to Home</a>
                      <a href="index.php" class="btn btn-sm btn-default m-1">Offers</a>
                      <a href="#" onclick="Databar('AddOffersCredits')" class="btn btn-sm btn-default m-1"><i class="fa fa-plus"></i> Add Offers Credits</a>
                      <h4 class="app-heading mb-0"><?php echo $PageName; ?> <small> | <?php echo $PageDescription; ?></small></h4>
                    </div>
                  </div>

                  <div class="row">
                    <?php
                    $AllRewards = FetchConvertIntoArray("SELECT * FROM offer_credits ORDER BY offer_credit_id DESC", true);
                    if ($AllRewards != null) {
                      $SerialNo = 0;
                      foreach ($AllRewards as $Req) {
                        $SerialNo++;
                    ?>
                        <div class="col-md-12">
                          <p class="data-list flex-s-b">
                            <span>
                              <span class='text-grey'>Sno</span><br>
                              <span><?php echo $SerialNo; ?></span>
                            </span>
                            <span>
                              <span class='text-grey'>OfferName</span><br>
                              <span class='bold'><?php echo FETCH("SELECT * FROM offers where OfferId='" . $Req->offer_main_id . "'", "OfferName"); ?></span>
                            </span>
                            <span>
                              <span class='text-grey'>StartAt</span><br>
                              <span><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM offers where OfferId='" . $Req->offer_main_id . "'", "OfferStartFrom")); ?></span>
                            </span>
                            <span>
                              <span class='text-grey'>EndedAt</span><br>
                              <span><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM offers where OfferId='" . $Req->offer_main_id . "'", "OfferEndDate")); ?></span>
                            </span>
                            <span>
                              <span class='text-grey'>Modal No</span><br>
                              <span><?php echo $Req->offer_on_modal_no; ?></span>
                            </span>
                            <span>
                              <span class="text-grey">Amount</span><br>
                              <span>Rs.<?php echo $Req->offer_credit_amount; ?>/reg</span>
                            </span>
                            <span>
                              <span class="text-grey">Action</span><br>
                              <a href="#" onclick="Databar('edit_offers_credit_<?php echo $Req->offer_credit_id; ?>')" class="text-primary">Edit Details</a>
                            </span>
                          </p>
                          <?php include $Dir . "/include/forms/UpdateOfferCredit.php"; ?>
                        </div>
                    <?php
                      }
                    } else {
                      NoData("No Offers Credits Found!");
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php
    include $Dir . "/include/forms/AddOfferCredit.php";
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>