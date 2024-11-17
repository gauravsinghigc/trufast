<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Offers";
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
                      <a href="credits.php" class="btn btn-sm btn-default m-1">Offers Credits</a>
                      <a href="#" onclick="Databar('AddOffers')" class="btn btn-sm btn-default m-1"><i class="fa fa-plus"></i> Add Offers</a>
                      <h4 class="app-heading mb-0"><?php echo $PageName; ?> <small> | <?php echo $PageDescription; ?></small></h4>
                    </div>
                  </div>

                  <div class="row">
                    <?php
                    $AllRewards = FetchConvertIntoArray("SELECT * FROM offers ORDER BY OfferId DESC", true);
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
                              <img src="<?php echo STORAGE_URL; ?>/offers/<?php echo $Req->OfferCreatives; ?>" class="list-icon">
                            </span>
                            <span>
                              <span class='text-grey'>OfferName</span><br>
                              <span class='bold'><?php echo $Req->OfferName; ?></span>
                            </span>
                            <span>
                              <span class='text-grey'>StartAt</span><br>
                              <span><?php echo DATE_FORMATE2("d M, Y", $Req->OfferStartFrom); ?></span>
                            </span>
                            <span>
                              <span class='text-grey'>EndedAt</span><br>
                              <span><?php echo DATE_FORMATE2("d M, Y", $Req->OfferEndDate); ?></span>
                            </span>
                            <span>
                              <span class='text-grey'>CreatedAt</span><br>
                              <span><?php echo DATE_FORMATE2("d M, Y", $Req->OfferCreatedAt); ?></span>
                            </span>
                            <span>
                              <span class="text-grey">Status</span><br>
                              <span><?php echo $Req->OfferStatus; ?></span>
                            </span>
                            <span>
                              <span class="text-grey">Action</span><br>
                              <a href="#" onclick="Databar('edit_offers_<?php echo $Req->OfferId; ?>')" class="text-primary">Edit Details</a>
                            </span>
                          </p>
                          <?php include $Dir . "/include/forms/UpdateOfferForm.php"; ?>
                        </div>
                    <?php
                      }
                    } else {
                      NoData("No Offers Found!");
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
    include $Dir . "/include/forms/AddOffers.php";
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>