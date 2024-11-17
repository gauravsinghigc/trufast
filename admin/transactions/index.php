<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Transactions";
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
                      <h5 class='app-heading'>All Service/Complaint Payments</h5>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="card p-2 bg-info">
                            <h4 class='mb-0'>Rs.<?php echo $Receiable = AMOUNT("SELECT * FROM complaint_charges", "complaint_charge_amount"); ?></h4>
                            <p class="small">Net Receivable</p>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="card p-2 bg-success">
                            <h4 class='mb-0'>Rs.<?php echo $Receiced = AMOUNT("SELECT * FROM complaint_charges where complaint_charge_status='PAID'", "complaint_charge_amount"); ?></h4>
                            <p class="small">Net Received</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card p-2 bg-danger">
                            <h4 class='mb-0'>Rs.<?php echo $Pendings = AMOUNT("SELECT * FROM complaint_charges where complaint_charge_status='UN-PAID'", "complaint_charge_amount"); ?></h4>
                            <p class="small">Pendings</p>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <form class="row">
                            <div class="col-md-4">
                              <input type="search" class="form-control" name="complaintno" placeholder="Complaint No">
                            </div>
                            <div class="col-md-4">
                              <input type="search" class="form-control" name="customername" placeholder="Customer Name">
                            </div>
                            <div class="col-md-4">
                              <input type="month" value='<?php echo IfRequested("GET", "paymentmonth", date('Y-m'), false); ?>' class="form-control" name="paymentmonth">
                            </div>
                          </form>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Sno</th>
                                  <th>ComplaintNo</th>
                                  <th>ComplaintDate</th>
                                  <th>ServiceCharge</th>
                                  <th>PayStatus</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $ComplaintPaymentMonths = IfRequested("GET", "paymentmonth", date("Y-m"), false);
                                $GetComplaints = FetchConvertIntoArray("SELECT * FROM complaint_charges ORDER BY complaint_charge_idc DESC", true);
                                if ($GetComplaints != null) {
                                  $SerialNo = SERIAL_NO;
                                  foreach ($GetComplaints as $Complaint) {
                                    $SerialNo++;
                                ?>
                                    <tr>
                                      <td><?php echo $SerialNo; ?></td>
                                      <td>
                                        <a class='text-primary' href="<?php echo ADMIN_URL; ?>/complaints/details?id=<?php echo $Complaint->complaint_main_id; ?>">
                                          <?php echo FETCH("SELECT * FROM complaints where ComplaintsId='" . $Complaint->complaint_main_id . "'", "ComplaintsCustomRefId"); ?>
                                        </a>
                                      </td>
                                      <td>
                                        <?php echo DATE_FORMATE("d M, Y", $Complaint->complaint_charge_receive_at); ?>
                                      </td>
                                      <td>
                                        <?php echo Price($Complaint->complaint_charge_amount, "", "Rs."); ?>
                                      </td>
                                      <td>
                                        <?php echo PayStatus($Complaint->complaint_charge_status); ?>
                                      </td>
                                      <td>
                                        <a href="<?php echo ADMIN_URL; ?>/complaints/details?id=<?php echo $Complaint->complaint_main_id; ?>" class='btn btn-sm btn-success'>Details</a>
                                      </td>
                                    </tr>
                                <?php
                                  }
                                } else {
                                  NoDataTableView("No Transactions found!", "6");
                                }
                                ?>
                              </tbody>
                            </table>

                          </div>
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