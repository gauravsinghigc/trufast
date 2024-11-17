 <section class='pop-window' id="Upgrade_<?php echo $Cards->WarrantyProductsId; ?>">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <h5 class='app-heading'>Warranty Upgrade Request</h5>
       </div>
     </div>
     <form action="<?php echo CONTROLLER; ?>/WarrantyController.php" method="POST" class="row">
       <?php FormPrimaryInputs(true, [
          "warranty_card_id" => $Cards->WarrantyProductsId,
          "warranty_upgrade_customer_id" => $Cards->WarrantyCustomerId,
          "warranty_upgrade_vendor_id" => $Cards->warranty_main_reg_id
        ]); ?>
       <div class="row">
         <div class='col-md-4 form-group'>
           <label>Current Expire Date <span class='text-danger'>*</span></label>
           <input readonly type='date' value='<?php echo $Cards->WarrantyExpireDate; ?>' name="warranty_upgrade_current_expire_date" class="form-control form-control-sm">
         </div>

         <div class='col-md-4 form-group'>
           <label>New Expire Date <span class='text-danger'>*</span></label>
           <input type='date' value='<?php echo $Cards->WarrantyExpireDate; ?>' name="warranty_upgrade_request_date" class="form-control form-control-sm">
         </div>

         <div class="col-md-12 mt-3 text-right">
           <a href="#" onclick="Databar('Upgrade_<?php echo $Cards->WarrantyProductsId; ?>')" class="btn btn-sm btn-default">Cancel</a>
           <button type="submit" name="SendWarrantyUpgradeRequest" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Sent Request</button>
         </div>
       </div>
     </form>
   </div>
 </section>