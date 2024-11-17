<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';

//processing
if (isset($_POST['SaveRewardRecord'])) {
    RequestHandler(
        INSERT("rewards", [
            "RewardName" => $_POST['RewardName'],
            "RewardDetails" => POST("RewardDetails"),
            "RewardApplicableOnPoints" => $_POST['RewardApplicableOnPoints'],
            "RewardCreatedAt" => RequestDataTypeDate,
            "RewardUpdatedAt" => RequestDataTypeDate,
            "RewardExpireInDays" => $_POST['RewardExpireInDays'],
            "RewardStatus" => $_POST['RewardStatus'],
            "RewardStartFrom" => $_POST['RewardStartFrom'],
            "RewardApplicableOnlyFor" => $_POST['RewardApplicableOnlyFor']
        ]),
        [
            "true" => "<b>" . $_POST['RewardName'] . "</b> is saved successfully!",
            "false" => "Unable to save <b>" . $_POST['RewardName'] . "</b> details at the moment!",
        ]
    );

    //update reward details
} elseif (isset($_POST['UpdateRewardRecord'])) {
    RequestHandler(
        UPDATE_DATA(
            "rewards",
            [
                "RewardName" => $_POST['RewardName'],
                "RewardDetails" => POST("RewardDetails"),
                "RewardApplicableOnPoints" => $_POST['RewardApplicableOnPoints'],
                "RewardUpdatedAt" => RequestDataTypeDate,
                "RewardExpireInDays" => $_POST['RewardExpireInDays'],
                "RewardStatus" => $_POST['RewardStatus'],
                "RewardStartFrom" => $_POST['RewardStartFrom'],
                "RewardApplicableOnlyFor" => $_POST['RewardApplicableOnlyFor']
            ],
            "RewardId='" . SECURE($_POST['RewardId'], "d") . "'"
        ),
        [
            "true" => "<b>" . $_POST['RewardName'] . "</b> is updated successfully!",
            "false" => "Unable to update <b>" . $_POST['RewardName'] . "</b> details at the moment!",
        ]
    );

    //remove record
} elseif (isset($_GET['remove_reward_record'])) {
    HandlerDeleteRequests("remove_reward_record", [
        "rewards" => "RewardId='" . SECURE($_GET['control_id'], "d") . "'",
    ], [
        "true" => "Reward Details are removed successfully!",
        "false" => "Unable to remove reward details at the moment!"
    ]);
}
