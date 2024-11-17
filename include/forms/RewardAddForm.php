 <section class='pop-window' id="AddRewards">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h5 class='app-heading'>Add New Rewards</h5>
             </div>
         </div>
         <form action="<?php echo CONTROLLER; ?>/RewardController.php" method="POST" class="row">
             <?php
                FormPrimaryInputs(true);
                ?>
             <div class='col-md-4 form-group'>
                 <label>RewardName <span class='text-danger'>*</span></label>
                 <input type='text' name="RewardName" class="form-control form-control-sm">
             </div>
             <div class='col-md-6 col-6 form-group'>
                 <label>Registrations Required <span class='text-danger'>*</span></label>
                 <input type='number' name="RewardApplicableOnPoints" class="form-control form-control-sm">
             </div>
             <div class='col-md-2 col-6 form-group'>
                 <label>Start from <span class='text-danger'>*</span></label>
                 <input type='date' name="RewardStartFrom" class="form-control form-control-sm">
             </div>
             <div class="form-group col-md-3">
                 <label>Expire in Days <?php echo $req; ?></label>
                 <select name="RewardExpireInDays" class="form-control form-control-sm" required="">
                     <?php InputOptions([
                            "Select days", 10, 15, 20, 25, 30, 45, 50, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330, 360
                        ]); ?>
                 </select>
             </div>
             <div class='col-md-4 form-group'>
                 <label>Points Per Registrations <span class='text-danger'>*</span></label>
                 <input type='number' name="RewardApplicableOnlyFor" class=" form-control form-control-sm">
             </div>
             <div class="form-group col-md-3">
                 <label>Select Reward Status <?php echo $req; ?></label>
                 <select name="RewardStatus" class="form-control form-control-sm" required="">
                     <?php InputOptions([
                            "Select Status", "Active", "Inactive", "Running", "Exired"
                        ]); ?>
                 </select>
             </div>
             <div class="col-md-12">
                 <p class="fs-6">Active status will be auto run Reward as per Reward Started From Date. rest will be inactive.</p>
             </div>
             <div class="form-group col-md-12">
                 <label>Reward description <?php echo $req; ?></label>
                 <textarea name="RewardDetails" class="form-control form-control-sm editor" rows="5"></textarea>
             </div>

             <div class="col-md-12 mt-3 text-right">
                 <a href="#" onclick="Databar('AddRewards')" class="btn btn-sm btn-default">Cancel</a>
                 <button type="submit" name="SaveRewardRecord" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Save Record</button>
             </div>
         </form>
     </div>
 </section>