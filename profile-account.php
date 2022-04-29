<?php
ob_start();
session_start();
$pageTitle = 'My Account';
include 'config.php';
?>

<div class="wrapper main_con bg-white mt-sm-5">
    <h4 class="pb-4 header_acc border-bottom">Account settings</h4>
    <div class="d-flex align-items-start py-3 border-bottom">
        <img src="https://images.pexels.com/photos/1037995/pexels-photo-1037995.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img_acc" alt="">
        <div class="pl-sm-4 pl-2" id="img-section"> <b>Profile Photo</b>
            <p>Accepted file type .png. Less than 1MB</p> <button class="btn button border"><b>Upload</b></button>
        </div>
    </div>
    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-12 pt-md-0 pt-3"> <label class="label_head" for="fullname">Full Name</label> <input type="text" class="bg-light form-control" placeholder="Steve"> </div>
        </div>
        <div class="row py-2">
            <div class="col-md-12"> <label class="label_head" for="email">Email Address</label> <input type="text" class="bg-light form-control" placeholder="steve_@email.com"> </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6"> <label class="label_head" for="country">Country</label> <select name="country" id="country" class="bg-light">
                    <option value="india" selected>India</option>
                    <option value="usa">USA</option>
                    <option value="uk">UK</option>
                    <option value="uae">UAE</option>
                </select> </div>
            <div class="col-md-6 pt-md-0 pt-3" id="lang"> <label class="label_head" for="language">Language</label>
                <div class="arrow"> <select name="language" id="language" class="bg-light">
                        <option value="english" selected>English</option>
                        <option value="english_us">English (United States)</option>
                        <option value="enguk">English UK</option>
                        <option value="arab">Arabic</option>
                    </select> </div>
            </div>
        </div>
        <div class="py-3 pb-4 border-bottom"> <button class="btn btn-primary mr-3">Save Changes</button> <button class="btn border button">Cancel</button> </div>
    </div>
</div>