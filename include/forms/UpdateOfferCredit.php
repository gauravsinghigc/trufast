 <section class='pop-window' id="edit_offers_credit_<?php echo $Req->offer_credit_id; ?>">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <h5 class='app-heading'>Update Offers Credit</h5>
       </div>
     </div>
     <form action="<?php echo CONTROLLER; ?>/OfferController.php" enctype="multipart/form-data" method="POST" class="row">
       <?php
        FormPrimaryInputs(true, [
          "offer_credit_id" => $Req->offer_credit_id
        ]);
        ?>
       <div class='col-md-4 form-group'>
         <label>Select Offer <span class='text-danger'>*</span></label>
         <select name='offer_main_id' class='form-control'>
           <?php
            $FetchAllActiveOffers = FetchConvertIntoArray("SELECT * FROM offers where OfferStatus='Active'", true);
            if ($FetchAllActiveOffers != null) { ?>
             <option value='0'>Select Offer</option>
             <?php
              foreach ($FetchAllActiveOffers as $Offer) {
                if ($Offer->OfferId == $Req->offer_main_id) {
                  $selected = "selected";
                } else {
                  $selected = "";
                } ?>
               <option value='<?php echo $Offer->OfferId; ?>' <?php echo $selected; ?>><?php echo $Offer->OfferName; ?></option>
           <?php }
            } else {
              echo '<option value="">No Offer Found!</option>';
            } ?>
         </select>
       </div>
       <div class='col-md-4'>
         <label>Modal No</label>
         <input type='text' name='offer_on_modal_no' value='<?php echo $Req->offer_on_modal_no; ?>' class="form-control" required=''>
       </div>
       <div class='col-md-4'>
         <label>Credit Amount/Registration</label>
         <input type='text' name='offer_credit_amount' value='<?php echo $Req->offer_credit_amount; ?>' class="form-control" required=''>
       </div>


       <div class="col-md-12 mt-3 text-right">
         <a href="#" onclick="Databar('edit_offers_credit_<?php echo $Req->offer_credit_id; ?>')" class="btn btn-sm btn-default">Cancel</a>
         <button type="submit" name="UpdateOfferCreditDetails" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Update Record</button>
       </div>
     </form>
   </div>
 </section>