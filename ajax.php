<?php
include_once "./model/functions.php";

$functions = new functions();

if (isset($_POST['action']) && $_POST['action'] == 'add_subscriber') {

    $email = trim($_POST['email']);
    $category = trim($_POST['category']);

    if ($functions->addSubscriber($email, $category)) {
        echo "success";
    } else {
        echo "failed";
    }

    exit;
}



// if (!isset($_POST['country_id'])) {
//     exit;
// }

// $country_id = (int)$_POST['country_id'];
// $state_id   = isset($_POST['state_id']) ? (int)$_POST['state_id'] : 0;

// if ($state_id > 0) {
//     $cities = $functions->getCities($country_id, $state_id);
//     echo '<option value="">--Select City--</option>';
//     foreach ($cities as $city) {
//         echo '<option value="'.$city['id'].'">'.$city['city_name'].'</option>';
//     }
//     exit;
// }

// $states = $functions->getStates($country_id);

// $stateOptions = '<option value="">--Select State--</option>';
// foreach ($states as $state) {
//     $stateOptions .= '<option value="'.$state['id'].'">'.$state['state_name'].'</option>';
// }
// $cityOptions = '<option value="">--Select City--</option>';
// if (empty($states)) {
//     foreach ($functions->getCities($country_id) as $city) {
//         $cityOptions .= '<option value="'.$city['id'].'">'.$city['city_name'].'</option>';
//     }
// }
// echo $stateOptions . '|||' . $cityOptions;





if (!isset($_POST['country_id'])) {
    exit;
}

$country_id = (int)$_POST['country_id'];
$state_id   = isset($_POST['state_id']) ? (int)$_POST['state_id'] : 0;

/* State selected -> Return only cities */
if ($state_id > 0) {

    $cities = $functions->getCities($country_id, $state_id);

    // Some existing city records are not linked to a state (state_id = 0).
    // In that case, still show the cities for the selected country.
    if (empty($cities)) {
        $cities = $functions->getCities($country_id);
    }

    echo '<option value="">--Select City--</option>';

    foreach ($cities as $city) {
        echo '<option value="'.$city['id'].'">'.$city['city_name'].'</option>';
    }

    exit;
}

/* Country selected -> Return states + all cities */

$states = $functions->getStates($country_id);
$cities = $functions->getCities($country_id);

$stateOptions = '<option value="">--Select State--</option>';
foreach ($states as $state) {
    $stateOptions .= '<option value="'.$state['id'].'">'.$state['state_name'].'</option>';
}

$cityOptions = '<option value="">--Select City--</option>';
foreach ($cities as $city) {
    $cityOptions .= '<option value="'.$city['id'].'">'.$city['city_name'].'</option>';
}

echo $stateOptions . '|||' . $cityOptions;
