<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Customers";
$PageDescription = "Manage all customers";

if (isset($_SESSION['REGISTRATION_NO'])) {
    $RegistrationNo = $_SESSION['REGISTRATION_NO'];
} else {
    $RegistrationNo = "REG0" . date('dmy') . "/" . rand(00000, 99999999);
    $_SESSION['REGISTRATION_NO'] = $RegistrationNo;
}
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
            document.getElementById("profile").classList.add("active");
            document.getElementById("profile_view").classList.add("active");
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

                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <h4 class='app-heading'>New Registrations</h4>
                                        </div>
                                    </div>

                                    <form action='<?php echo CONTROLLER; ?>/RegistrationController.php' enctype="multipart/form-data" method="POST" class="row">
                                        <?php FormPrimaryInputs(true);  ?>
                                        <div class='col-md-6'>
                                            <h5 class='app-sub-heading'>Customer Details</h5>
                                            <div class='row'>
                                                <div class='col-md-6 form-group'>
                                                    <label>Customer Name <?php echo $req; ?></label>
                                                    <input type="text" name="UserFullName" class="form-control form-control-sm" required="">
                                                </div>
                                                <div class='col-md-6 form-group'>
                                                    <label>Other/Display Name <?php echo $req; ?></label>
                                                    <input type="text" name="UserCompanyName" class="form-control form-control-sm" required="">
                                                </div>
                                                <div class='col-md-6 form-group'>
                                                    <label>Phone No <?php echo $req; ?> <span id='phonemsg'></span></label>
                                                    <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" name="UserPhoneNumber" class="form-control form-control-sm" required="">
                                                </div>
                                                <div class='col-md-6 form-group'>
                                                    <label>Email-ID <span id='emailmsg'></span></label>
                                                    <input type="email" oninput="CheckExistingMailId()" id="EmailId" name="UserEmailId" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6 class='app-sub-heading'>Address Details</h6>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label>House No/Flat No/Villa No <?php echo $req; ?></label>
                                                            <textarea name="CustomerStreetAddress" id="street" class="form-control form-control-sm" rows="2"></textarea>
                                                        </div>
                                                        <div class='col-md-7 form-group'>
                                                            <label>Sector/Area Locality <?php echo $req; ?></label>
                                                            <input type="text" name="CustomerAreaLocality" id="area" class="form-control form-control-sm">
                                                        </div>
                                                        <div class='col-md-5 form-group'>
                                                            <label>City <?php echo $req; ?></label>
                                                            <input type="text" name="CustomerCity" id="city" class="form-control form-control-sm">
                                                        </div>
                                                        <div class='col-md-6 form-group'>
                                                            <label>State <?php echo $req; ?></label>
                                                            <input type="text" name="CustomerState" id="state" class="form-control form-control-sm">
                                                        </div>
                                                        <div class='col-md-6 form-group'>
                                                            <label>Country <?php echo $req; ?></label>
                                                            <input type="text" name="CustomerCountry" id="country" class="form-control form-control-sm">
                                                        </div>
                                                        <div class='col-md-6 form-group'>
                                                            <label>Pincode <?php echo $req; ?></label>
                                                            <input type="text" name="CustomerPincode" id="pincode" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <h5 class='app-sub-heading'>Product Details</h5>
                                            <input type="hidden" name="WarrantyStatus" id="status">
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label>Product Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="ProductName" value="">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Serial No</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="WarrantyProductSno" value="">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Modal No</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" list="ProductModalNo" name="WarrantyProductModalNo" value="">
                                                    <?php SUGGEST("products", "ProductModalNo", "ASC"); ?>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Mfg Date</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date" id="MfgDate" class="form-control form-control-sm" oninput="GetExpireDate()" name="WarrantyProductMfgDate" value="">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Purchase Date</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date" oninput="GetExpireDate()" id="purchasedate" class="form-control form-control-sm" name="WarrantyProductPurchasedate" value="">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Capacity (AH)</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" list="ProductCapacity" name="WarrantyProductCapacity" value="">
                                                    <?php SUGGEST("products", "ProductCapacity", "ASC"); ?>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Warranty (in Months)</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" id="months" class="form-control form-control-sm" oninput="GetExpireDate()" name="WarrantyProductMonthWarranty" value="">
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Product life (in Years)</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" oninput="GetExpireDate()" list="ProductLife" name="WarrantyProductLife" value="">
                                                    <?php SUGGEST("products", "ProductLife", "ASC"); ?>
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Warranty Expired date</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date" readonly="" id="expiredate" class="form-control form-control-sm" name="WarrantyExpireDate" value="">
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label>Warranty Status</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span class="btn btn-sm" id='warrantystatus'></span>
                                                </div>

                                                <div class='col-md-12'>
                                                    <h6 class='app-sub-heading'>Upload Image</h6>
                                                    <div class="form-group">
                                                        <label>Upload Image</label>
                                                        <input type="file" class="form-control" name='registration_file' accept='image/*'>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12 text-right'>
                                                <button type='submit' id='subbtn' class='btn btn-lg btn-success' name='CreateRegistration'><i class='fa fa-check'></i> Complete Registration</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>

        <?php
        include $Dir . "/include/admin/footer.php"; ?>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>
    <script>
        function CheckExistingPhoneNumbers() {
            let SearchingFor = document.getElementById("PhoneNumber");
            var phonemsg = document.getElementById("phonemsg");
            var pattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
            var subbtn = document.getElementById("subbtn");
            let ExistingPhoneNumbers = [<?php
                                        $AllData = FetchConvertIntoArray("SELECT * FROM users", true);
                                        if ($AllData != null) {
                                            foreach ($AllData as $Data) {
                                                echo "'" . $Data->UserPhoneNumber . "', ";
                                            }
                                        } ?>];

            if (ExistingPhoneNumbers.includes(SearchingFor.value)) {
                phonemsg.classList.add("text-danger");
                phonemsg.classList.remove("text-warning");
                phonemsg.innerHTML = "<i class='fa fa-warning'></i> Phone Number Already Exits";
                subbtn.type = "button";
            } else if (pattern.test(SearchingFor.value) == false) {
                phonemsg.classList.add("text-warning");
                phonemsg.classList.remove("text-danger");
                phonemsg.innerHTML = "<i class='fa fa-warning'></i> Phone Number is not valid";
                subbtn.type = "button";
            } else {
                phonemsg.classList.remove("text-danger");
                phonemsg.classList.remove("text-warning");
                phonemsg.classList.add("text-success");
                phonemsg.innerHTML = "<i class='fa fa-check'></i> Phone Number is Ok";
                subbtn.type = "submit";
            }
        }

        function CheckExistingMailId() {
            let SearchingFor = document.getElementById("EmailId");
            var emailmsg = document.getElementById("emailmsg");
            var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var subbtn = document.getElementById("subbtn");
            let CheckExistingMailId = [<?php
                                        $AllData = FetchConvertIntoArray("SELECT * FROM users", true);
                                        if ($AllData != null) {
                                            foreach ($AllData as $Data) {
                                                echo "'" . $Data->UserEmailId . "', ";
                                            }
                                        } ?>];

            if (CheckExistingMailId.includes(SearchingFor.value)) {
                emailmsg.classList.add("text-danger");
                emailmsg.classList.remove("text-warning");
                emailmsg.innerHTML = "<i class='fa fa-warning'></i> Email-Id Already Exits";
                subbtn.type = "button";
            } else if (pattern.test(SearchingFor.value) == false) {
                emailmsg.classList.add("text-warning");
                emailmsg.classList.remove("text-danger");
                emailmsg.innerHTML = "<i class='fa fa-warning'></i> Email-ID is not valid";
                subbtn.type = "button";
            } else {
                emailmsg.classList.remove("text-danger");
                emailmsg.classList.remove("text-warning");
                emailmsg.classList.add("text-success");
                emailmsg.innerHTML = "<i class='fa fa-check'></i> Email-ID is Ok";
                subbtn.type = "submit";
            }
        }

        function CopyAddressdeatils() {
            var CopyAddress = document.getElementById("CopyAddress");
            if (CopyAddress.checked) {
                document.getElementById("street1").value = document.getElementById("street").value;
                document.getElementById("area1").value = document.getElementById("area").value;
                document.getElementById("city1").value = document.getElementById("city").value;
                document.getElementById("state1").value = document.getElementById("state").value;
                document.getElementById("country1").value = document.getElementById("country").value;
                document.getElementById("pincode1").value = document.getElementById("pincode").value;
            } else {
                document.getElementById("street1").value = "";
                document.getElementById("area1").value = "";
                document.getElementById("city1").value = "";
                document.getElementById("state1").value = "";
                document.getElementById("country1").value = "";
                document.getElementById("pincode1").value = "";
            }
        }
    </script>

    <script>
        function GetExpireDate() {
            var purchasedate = document.getElementById("purchasedate");
            var months = document.getElementById("months");
            var expiredate = document.getElementById("expiredate");
            var MfgDate = document.getElementById("MfgDate");
            var warrantystatus = document.getElementById("warrantystatus");
            var status = document.getElementById("status");

            var GetPurchaseData = new Date(purchasedate.value);
            GetPurchaseData.setMonth(GetPurchaseData.getMonth() + +months.value);
            var NewExpireData = GetPurchaseData;

            //birthday date checking
            const today = NewExpireData;
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            const formattedToday = yyyy + '-' + mm + '-' + dd;
            expiredate.value = formattedToday;
            var datetimeStart = new Date();

            if (Date.parse(NewExpireData) > Date.parse(datetimeStart)) {
                warrantystatus.innerHTML = "<i class='fa fa-check'></i>" + " Active";
                warrantystatus.classList.add("btn-success");
                warrantystatus.classList.remove("btn-danger");
                status.value = "Active";
            } else {
                warrantystatus.innerHTML = "<i class='fa fa-warning'></i>" + " Expired";
                warrantystatus.classList.add("btn-danger");
                warrantystatus.classList.remove("btn-success");
                status.value = "Expired";
            }
        }
    </script>

</body>

</html>