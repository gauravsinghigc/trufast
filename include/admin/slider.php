<div class="row">
 <div class="col-md-12">
  <?php
  $AllRewards = FetchConvertIntoArray("SELECT * FROM offers where OfferStatus='Active' ORDER BY OfferId DESC limit 1", true);
  if ($AllRewards != null) {
   $SerialNo = 0;
   foreach ($AllRewards as $Req) { ?>
    <img src="<?PHP echo STORAGE_URL; ?>/offers/<?php echo $Req->OfferCreatives; ?>" class="img-fluid w-100">
  <?php }
  } ?>
 </div>
</div>