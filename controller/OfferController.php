<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';


//start processing
if (isset($_POST['SaveOfferDetails'])) {
  $offers = [
    "OfferName" => $_POST['OfferName'],
    "OfferStartFrom" => $_POST['OfferStartFrom'],
    "OfferEndDate" => $_POST['OfferEndDate'],
    "OfferDescriptions" => SECURE($_POST['OfferDescriptions'], "e"),
    "OfferCreatedAt" => RequestDataTypeDate,
    "OfferUpdatedAt" => RequestDataTypeDate,
    "OfferStatus" => $_POST['OfferStatus'],
    "OfferCreatives" => UPLOAD_FILES("../storage/offers", "null", "Offer_Creative", "file", "OfferCreatives"),
  ];
  RESPONSE(INSERT("offers", $offers), "Offer Details are saved successfully!", "Unable to add offer details at the moment!");

  //update offer details
} elseif (isset($_POST['UpdateOfferDetails'])) {
  $OfferId = SECURE($_POST['OfferId'], "d");

  $offers = [
    "OfferName" => $_POST['OfferName'],
    "OfferStartFrom" => $_POST['OfferStartFrom'],
    "OfferEndDate" => $_POST['OfferEndDate'],
    "OfferDescriptions" => SECURE($_POST['OfferDescriptions'], "e"),
    "OfferCreatedAt" => RequestDataTypeDate,
    "OfferStatus" => $_POST['OfferStatus'],
  ];
  RESPONSE(UPDATE_DATA("offers", $offers, "OfferId='$OfferId'"), "Offer Details are updated successfully!", "Unable to update offer details at the moment!");

  //remove offer details
} elseif (isset($_GET['remove_slider_record'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $remove_slider_record = SECURE($_GET['remove_slider_record'], "d");

  if ($remove_slider_record == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $Response = DELETE_FROM("offers", "OfferId='$control_id'");
  } else {
    $Response = false;
  }
  RESPONSE($Response, "Offer details are removed successfully!", "Unable to remove offer details at the moment");

  //offer credit amount
} elseif (isset($_POST['SaveOfferCreditDetails'])) {
  $offer_credits = [
    "offer_main_id" => $_POST['offer_main_id'],
    "offer_on_modal_no" => $_POST['offer_on_modal_no'],
    "offer_credit_amount" => $_POST['offer_credit_amount']
  ];
  $Response = INSERT("offer_credits", $offer_credits);
  RESPONSE($Response, "Offer credits details are saved successfully!", "Unable to save offer credits details at the moment");

  //update offer credit details
} elseif (isset($_POST['UpdateOfferCreditDetails'])) {
  $offer_credit_id = SECURE($_POST['offer_credit_id'], "d");
  $offer_credits = [
    "offer_main_id" => $_POST['offer_main_id'],
    "offer_on_modal_no" => $_POST['offer_on_modal_no'],
    "offer_credit_amount" => $_POST['offer_credit_amount']
  ];
  $Response = UPDATE_DATA("offer_credits", $offer_credits, "offer_credit_id='$offer_credit_id'");
  RESPONSE($Response, "Offer credits details are updated successfully!", "Unable to update offer credits details at the moment");
}
