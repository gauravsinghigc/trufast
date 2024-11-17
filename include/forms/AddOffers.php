 <section class='pop-window' id="AddOffers">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <h5 class='app-heading'>Add New Offers</h5>
       </div>
     </div>
     <form action="<?php echo CONTROLLER; ?>/OfferController.php" enctype="multipart/form-data" method="POST" class="row">
       <?php
        FormPrimaryInputs(true);
        ?>
       <div class='col-md-4 form-group'>
         <label>Offer Name <span class='text-danger'>*</span></label>
         <input type='text' name="OfferName" class="form-control form-control-sm">
       </div>
       <div class='col-md-3 col-6 form-group'>
         <label>Start From <span class='text-danger'>*</span></label>
         <input type='date' name="OfferStartFrom" class="form-control form-control-sm">
       </div>
       <div class='col-md-3 col-6 form-group'>
         <label>Ended On <span class='text-danger'>*</span></label>
         <input type='date' name="OfferEndDate" class="form-control form-control-sm">
       </div>
       <div class="form-group col-md-4">
         <label>Offer Status <?php echo $req; ?></label>
         <select name="OfferStatus" class="form-control form-control-sm" required="">
           <?php InputOptions([
              "Select Status", "Active", "Inactive", "Exired"
            ]); ?>
         </select>
       </div>
       <div class="form-group col-md-6">
         <label>Upload Creative <?php echo $req; ?> <span class="text-grey">image size will be 900x150</span></label>
         <input type="file" name="OfferCreatives" class="form-control form-control-sm" required="" accept="image/*">
       </div>
       <div class=" col-md-12">
         <p class="fs-6">Active status will be auto run offer as per Start Date. rest will be inactive.</p>
       </div>
       <div class="form-group col-md-12">
         <label>Offer description <?php echo $req; ?></label>
         <textarea name="OfferDescriptions" class="form-control form-control-sm editor" rows="5"></textarea>
       </div>

       <div class="col-md-12 mt-3 text-right">
         <a href="#" onclick="Databar('AddOffers')" class="btn btn-sm btn-default">Cancel</a>
         <button type="submit" name="SaveOfferDetails" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Save Record</button>
       </div>
     </form>
   </div>
 </section>