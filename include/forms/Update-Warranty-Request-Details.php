 <section class='pop-window' id="View_Upgrade_Details_<?php echo $Cards->WarrantyProductsId; ?>">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <h5 class='app-heading'>Warranty Upgrade Request</h5>
       </div>
     </div>
     <form action="<?php echo CONTROLLER; ?>/WarrantyController.php" method="POST" class="row">
       <?php FormPrimaryInputs(true, [
          "warranty_upgrade_id" => FETCH("SELECT * FROM warranty_upgrade_requests WHERE warranty_card_id='" . $Cards->WarrantyProductsId . "'", "warranty_upgrade_id")
        ]);
        $warranty_upgrade_status = FETCH("SELECT * FROM warranty_upgrade_requests WHERE warranty_card_id='" . $Cards->WarrantyProductsId . "'", "warranty_upgrade_status");
        ?>
       <div class="row">
         <div class='col-md-4 form-group'>
           <label>Current Expire Date <span class='text-danger'>*</span></label>
           <input readonly type='date' value='<?php echo $Cards->WarrantyExpireDate; ?>' name="warranty_upgrade_current_expire_date" class="form-control form-control-sm">
         </div>

         <div class='col-md-4 form-group'>
           <label>New Expire Date <span class='text-danger'>*</span></label>
           <input type='date' value='<?php echo FETCH("SELECT * FROM warranty_upgrade_requests WHERE warranty_card_id='" . $Cards->WarrantyProductsId . "'", "warranty_upgrade_request_date"); ?>' name="warranty_upgrade_request_date" class="form-control form-control-sm">
         </div>

         <div class='col-md-4 form-group'>
           <label>Update Request Status</label>
           <select name="warranty_upgrade_status" class="form-control form-control-sm">
             <?php InputOptions(['Approve', 'Reject', 'Select Status'], $warranty_upgrade_status); ?>
           </select>
         </div>

         <div class="col-md-6 form-group">
           <h6 class='app-sub-heading'>Customer Details</h6>
           <?php
            $CustomerId = FETCH("SELECT * FROM warranty_upgrade_requests WHERE warranty_card_id='" . $Cards->WarrantyProductsId . "'", "warranty_upgrade_customer_id");
            ?>
           <p class="shadow-sm p-3">
             <span class="bold"><?php echo FETCH("SELECT * FROM users where UserId='$CustomerId'", "UserFullName"); ?></span><br>
             <span><?php echo FETCH("SELECT * FROM users where UserId='$CustomerId'", "UserPhoneNumber"); ?></span><br>
             <span><?php echo FETCH("SELECT * FROM users where UserId='$CustomerId'", "UserEmailId"); ?></span><br>
           </p>
         </div>
         <div class="col-md-6 form-group">
           <h6 class='app-sub-heading'>Vendor Details</h6>
           <?php
            $VendorId = FETCH("SELECT * FROM warranty_upgrade_requests WHERE warranty_card_id='" . $Cards->WarrantyProductsId . "'", "warranty_upgrade_vendor_id");
            $warranty_upgrade_notes = FETCH("SELECT * FROM warranty_upgrade_requests WHERE warranty_card_id='" . $Cards->WarrantyProductsId . "'", "warranty_upgrade_notes");
            ?>
           <p class="shadow-sm p-3">
             <span class="bold"><?php echo FETCH("SELECT * FROM users where UserId='$VendorId'", "UserFullName"); ?></span><br>
             <span class="bold"><i class='fa fa-store'></i> <?php echo FETCH("SELECT * FROM users where UserId='$VendorId'", "UserCompanyName"); ?></span><br>
             <span><?php echo FETCH("SELECT * FROM users where UserId='$VendorId'", "UserPhoneNumber"); ?></span><br>
             <span><?php echo FETCH("SELECT * FROM users where UserId='$VendorId'", "UserEmailId"); ?></span><br>
           </p>
         </div>
         <div class='col-md-12 form-group'>
           <label>Enter Reason/Remark</label>
           <textarea name='warranty_upgrade_notes' class="form-control form-control-sm" rows="3"><?php echo SECURE($warranty_upgrade_notes, "d"); ?></textarea>
         </div>

         <div class="col-md-12 mt-3 text-right">
           <a href="#" onclick="Databar('View_Upgrade_Details_<?php echo $Cards->WarrantyProductsId; ?>')" class="btn btn-sm btn-default">Cancel</a>
           <button type="submit" name="UpdateWarrantyUpgradeRequest" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Update Status</button>
         </div>
       </div>
     </form>
   </div>
 </section>