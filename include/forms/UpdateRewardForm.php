 <section class='pop-window' id="update_rewards_<?php echo $Req->RewardId; ?>">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h5 class='app-heading'>Update Reward details</h5>
             </div>
         </div>
         <form action="<?php echo CONTROLLER; ?>/RewardController.php" method="POST" class="row">
             <?php
                FormPrimaryInputs(true, [
                    "RewardId" => $Req->RewardId
                ]);
                ?>
             <div class='col-md-4 form-group'>
                 <label>RewardName <span class='text-danger'>*</span></label>
                 <input type='text' name="RewardName" value="<?php echo $Req->RewardName; ?>" class="form-control form-control-sm">
             </div>
             <div class='col-md-6 col-6 form-group'>
                 <label>Registration Required <span class='text-danger'>*</span></label>
                 <input type='number' name="RewardApplicableOnPoints" value="<?php echo $Req->RewardApplicableOnPoints; ?>" class="form-control form-control-sm">
             </div>
             <div class='col-md-2 col-6 form-group'>
                 <label>Start from <span class='text-danger'>*</span></label>
                 <input type='date' name="RewardStartFrom" value="<?php echo $Req->RewardStartFrom; ?>" class="form-control form-control-sm">
             </div>
             <div class="form-group col-md-3">
                 <label>Expire in Days <?php echo $req; ?></label>
                 <select name="RewardExpireInDays" class="form-control form-control-sm" required="">
                     <?php InputOptions([
                            "Select days", 10, 15, 20, 25, 30, 45, 50, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330, 360
                        ], $Req->RewardExpireInDays); ?>
                 </select>
             </div>
             <div class='col-md-4 form-group'>
                 <label>Points Per Registration <span class='text-danger'>*</span></label>
                 <input type='number' name="RewardApplicableOnlyFor" value="<?php echo $Req->RewardApplicableOnlyFor; ?>" class=" form-control form-control-sm">
             </div>
             <div class="form-group col-md-3">
                 <label>Select Reward Status <?php echo $req; ?></label>
                 <select name="RewardStatus" class="form-control form-control-sm" required="">
                     <?php InputOptions([
                            "Select Status", "Active", "Inactive", "Running", "Exired"
                        ], $Req->RewardStatus); ?>
                 </select>
             </div>
             <div class="col-md-12">
                 <p class="fs-6">Active status will be auto run Reward as per Reward Started From Date. rest will be inactive.</p>
             </div>
             <div class="form-group col-md-12">
                 <label>Reward description <?php echo $req; ?></label>
                 <textarea name="RewardDetails" class="form-control form-control-sm editor" rows="5"><?php echo SECURE($Req->RewardDetails, "d"); ?></textarea>
             </div>

             <div class="col-md-12 mt-3 text-right">
                 <?php CONFIRM_DELETE_POPUP(
                        "reward_list",
                        [
                            "remove_reward_record" => true,
                            "control_id" => $Req->RewardId
                        ],
                        "RewardController",
                        "Remove Reward Permanently",
                        "btn btn-sm text-danger"
                    ); ?>
                 <a href="#" onclick="Databar('update_rewards_<?php echo $Req->RewardId; ?>')" class="btn btn-sm btn-default">Cancel</a>
                 <button type="submit" name="UpdateRewardRecord" value="UpdateRewardRecord" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Update Record</button>
             </div>
         </form>
     </div>
 </section>