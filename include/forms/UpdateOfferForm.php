<section class='pop-window' id="edit_offers_<?php echo $Req->OfferId; ?>">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <h5 class='app-heading'>Update Offers</h5>
   </div>
  </div>
  <form action="<?php echo CONTROLLER; ?>/OfferController.php" enctype="multipart/form-data" method="POST" class="row">
   <?php
   FormPrimaryInputs(true, [
    "OfferId" => $Req->OfferId
   ]);
   ?>
   <div class='col-md-4 form-group'>
    <label>Offer Name <span class='text-danger'>*</span></label>
    <input type='text' name="OfferName" value="<?php echo $Req->OfferName; ?>" class="form-control form-control-sm">
   </div>
   <div class='col-md-3 col-6 form-group'>
    <label>Start From <span class='text-danger'>*</span></label>
    <input type='date' name="OfferStartFrom" value="<?php echo $Req->OfferStartFrom; ?>" class="form-control form-control-sm">
   </div>
   <div class='col-md-3 col-6 form-group'>
    <label>Ended On <span class='text-danger'>*</span></label>
    <input type='date' name="OfferEndDate" value="<?php echo $Req->OfferEndDate; ?>" class="form-control form-control-sm">
   </div>
   <div class="form-group col-md-4">
    <label>Offer Status <?php echo $req; ?></label>
    <select name="OfferStatus" class="form-control form-control-sm" required="">
     <?php InputOptions([
      "Select Status", "Active", "Inactive", "Exired"
     ], $Req->OfferStatus); ?>
    </select>
   </div>
   <div class="col-md-12">
    <p class="fs-6">Active status will be auto run offer as per Start Date. rest will be inactive.</p>
   </div>
   <div class="form-group col-md-12">
    <label>Offer description <?php echo $req; ?></label>
    <textarea name="OfferDescriptions" class="form-control form-control-sm editor" rows="5"><?php echo SECURE($Req->OfferDescriptions, "d"); ?></textarea>
   </div>
   <div class="col-md-12 mt-3 text-right">
    <?php
    CONFIRM_DELETE_POPUP(
     "remove_Sliders",
     [
      "remove_slider_record" => true,
      "control_id" => $Req->OfferId
     ],
     "OfferController",
     "Remove Offer",
     "btn btn-sm text-danger"
    ); ?>
    <a href="#" onclick="Databar('edit_offers_<?php echo $Req->OfferId; ?>')" class="btn btn-sm btn-default">Cancel</a>
    <button type="submit" name="UpdateOfferDetails" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Update Record</button>
   </div>
  </form>
 </div>
</section>