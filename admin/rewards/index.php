<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Rewards";
$PageDescription = "Manage rewards";
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
                      <a href="#" onclick="Databar('AddRewards')" class="btn btn-sm btn-default m-1"><i class="fa fa-plus"></i> Add Rewards</a>
                      <h4 class="app-heading mb-0"><?php echo $PageName; ?> <small> | <?php echo $PageDescription; ?></small></h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 mt-1">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <?php
                            Tag(
                              "tr",
                              [
                                Tag("th", ["Sno"]),
                                Tag("th", ["RewardName"]),
                                Tag("th", ["Reg.Req"]),
                                Tag("th", ["Point/Reg"]),
                                Tag("th", ["StartFrom"]),
                                Tag("th", ["ExpireOn"]),
                                Tag("th", ["Status"]),
                                Tag("th", ["Action"])
                              ],
                            );

                            $AllRewards = FetchConvertIntoArray("SELECT * FROM rewards ORDER BY RewardId DESC", true);
                            if ($AllRewards != null) {
                              $SerialNo = 0;
                              foreach ($AllRewards as $Req) {
                                $SerialNo++;
                            ?>
                                <tr>
                                  <td><?php echo $SerialNo; ?></td>
                                  <td class="bold"><?php echo $Req->RewardName; ?></td>
                                  <td><?php echo $Req->RewardApplicableOnPoints; ?> Regs</td>
                                  <td><?php echo $Req->RewardApplicableOnlyFor; ?> Points</td>
                                  <td><?php echo DATE_FORMATE2("d M, Y", $Req->RewardStartFrom); ?></td>
                                  <td><?php echo date("d M, Y", strtotime("+" . $Req->RewardExpireInDays . " days")); ?></td>
                                  <td><?php echo $Req->RewardStatus; ?></td>
                                  <td>
                                    <a href="#" class="text-info" onclick="Databar('update_rewards_<?php echo $Req->RewardId; ?>')">View Details</a>
                                    <?php include $Dir . "/include/forms/UpdateRewardForm.php"; ?>
                                  </td>
                                </tr>
                            <?php

                              }
                            } else {
                              NoDataTableView("No Rewards Found!", "9");
                            }
                            ?>
                          </thead>
                          <tbody>
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
      </section>
    </div>

    <?php
    include $Dir . "/include/forms/RewardAddForm.php";
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>