<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Warranty Cards";
$PageDescription = "Manage all customers";

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
      document.getElementById("customers").classList.add("active");
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
                      <h4 class="app-heading"><?php echo $PageName; ?>
                        <a href="add-warranty.php" class='btn btn-sm btn-default small pull-right'><i class='fa fa-plus'></i> Add Warranty Card</a>
                      </h4>
                    </div>
                    <div class='col-md-4'>
                      <form>
                        <input type='search' value='<?php echo IfRequested("GET", "WarrantyProductSno", "", false); ?>' name='WarrantyProductSno' list='WarrantyProductSno' class='form-control' onchange="form.submit()" placeholder="Search Serial no...">
                        <?php SUGGEST("warranty_products", "WarrantyProductSno", "ASC"); ?>
                      </form>
                    </div>
                    <div class='col-md-12'>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sno</th>
                            <th>WarrantyNo</th>
                            <th>CustomerName</th>
                            <th>PhoneNumber</th>
                            <th>SerialNo</th>
                            <th>PurchaseDate</th>
                            <th>ExpireDate</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (isset($_GET['WarrantyProductSno'])) {
                            $WarrantyCards = FetchConvertIntoArray("SELECT * FROM warranty_products where WarrantyProductSno like '%" . $_GET['WarrantyProductSno'] . "%' ORDER BY WarrantyProductsId DESC", true);
                          } else {
                            $WarrantyCards = FetchConvertIntoArray("SELECT * FROM warranty_products ORDER BY WarrantyProductsId DESC", true);
                          }
                          if ($WarrantyCards != null) {
                            $Sno = 0;
                            foreach ($WarrantyCards as $Cards) {
                              $Sno++;
                              $WarrantyCustomerId = $Cards->WarrantyCustomerId;
                              $UserFullName = FETCH("SELECT * FROM users where UserId='$WarrantyCustomerId'", "UserFullName");
                              $UserPhoneNumber = FETCH("SELECT * FROM users WHERE UserId='$WarrantyCustomerId'", "UserPhoneNumber");
                          ?>
                              <tr>
                                <td><?php echo $Sno; ?></td>
                                <td><?php echo $Cards->WarrantyCustomId; ?></td>
                                <td>
                                  <a class='text-primary' href="../customers/details/?uid=<?php echo SECURE($WarrantyCustomerId, "e"); ?>">
                                    <?php echo $UserFullName; ?><br>
                                  </a>
                                </td>
                                <td> <span><?php echo $UserPhoneNumber; ?></span></td>
                                <td><?php echo $Cards->WarrantyProductSno; ?></td>
                                <td><?php echo DATE_FORMATE2("d M, Y", $Cards->WarrantyProductPurchasedate); ?></td>
                                <td><?php echo DATE_FORMATE2("d M, Y", $Cards->WarrantyExpireDate); ?></td>
                                <td><?php echo StatusViewWithText($Cards->WarrantyStatus); ?></td>
                                <td>
                                  <a href="../../edoc/warranty.php?warrantyid=<?php echo $Cards->WarrantyProductsId; ?>" class="btn btn-xs btn-success" target="_blank">View Card</a>
                                  <?php
                                  $CheckRequests = CHECK("SELECT * FROM warranty_upgrade_requests where warranty_card_id='" . $Cards->WarrantyProductsId . "'");
                                  if ($CheckRequests == null) { ?>
                                    <?php } else {
                                    $CheckNewRequests = CHECK("SELECT * FROM warranty_upgrade_requests where warranty_upgrade_status='NEW' and warranty_card_id='" . $Cards->WarrantyProductsId . "'");
                                    if ($CheckNewRequests != null) { ?>
                                      <a href="#" onclick="Databar('View_Upgrade_Details_<?php echo $Cards->WarrantyProductsId; ?>')" class="btn btn-xs btn-danger">Upgrade Received!</a>
                                      <?php } else {
                                      $CheckNewRequests = CHECK("SELECT * FROM warranty_upgrade_requests where warranty_upgrade_status='Approve' and warranty_card_id='" . $Cards->WarrantyProductsId . "'");
                                      if ($CheckNewRequests != null) {  ?>
                                        <a href="#" onclick="Databar('View_Upgrade_Details_<?php echo $Cards->WarrantyProductsId; ?>')" class="btn btn-xs btn-success">Approved</a>
                                      <?php }
                                      $CheckNewRequests = CHECK("SELECT * FROM warranty_upgrade_requests where warranty_upgrade_status='Reject' and warranty_card_id='" . $Cards->WarrantyProductsId . "'");
                                      if ($CheckNewRequests != null) {  ?>
                                        <a href="#" onclick="Databar('View_Upgrade_Details_<?php echo $Cards->WarrantyProductsId; ?>')" class="btn btn-xs btn-danger">Rejected</a>
                                  <?php }
                                    }
                                  } ?>
                                </td>
                              </tr>
                          <?php
                              include $Dir . "/include/forms/Update-Warranty-Request-Details.php";
                            }
                          } else {
                            NoDataTableView("No Warranty Cards Found!", "8");
                          } ?>
                        </tbody>
                      </table>
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