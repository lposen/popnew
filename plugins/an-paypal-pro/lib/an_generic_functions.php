<?php

function formSelect($var_name, $selected, $options, $empty = "", $errorclass = "") {
    // Create and return an HTML <SELECT>

    $select = "<SELECT id='$var_name' name='$var_name' $errorclass>\n";

    if ($empty > "") {
        $select .= "<OPTION VALUE=''>$empty</OPTION>\n";
    }

    foreach ($options AS $value => $option) {
        $select .= "<OPTION VALUE='$value'";

        if (is_array($selected)) {
            if (in_array($value, $selected)) {
                $select .= " SELECTED";
            }
        } else {
            if ($value == $selected) {
                $select .= " SELECTED";
            }
        }

        $select .= ">" . htmlSafe($option) . "</OPTION>\n";
    }

    $select .= "</SELECT>\n";
    return $select;
}

$state_select = array('AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming');


// CANADIAN PROVINCES
$province_select = array(
    'AB' => 'Alberta',
    'BC' => 'British Columbia',
    'MB' => 'Manitoba',
    'NB' => 'New Brunswick',
    'NL' => 'Newfoundland and Labrador',
    'NT' => 'Northwest Territories',
    'NS' => 'Nova Scotia',
    'NU' => 'Nunavut',
    'ON' => 'Ontario',
    'PE' => 'Prince Edward Island',
    'QC' => 'Quebec',
    'SK' => 'Saskatchewan',
    'YT' => 'Yukon Territory'
);

$country_select = array("US" => "United States", "AR" => "Argentina", "AU" => "Australia", "AT" => "Austria", "BS" => "Bahamas",
    "BH" => "Bahrain", "BE" => "Belgium", "BM" => "Bermuda", "BO" => "Bolivia", "BR" => "Brazil", "BG" => "Bulgaria", "CA" => "Canada",
    "CL" => "Chile", "CO" => "Colombia", "CY" => "Cyprus", "DK" => "Denmark", "EC" => "Ecuador", "EG" => "Egypt", "ES" => "Espanol/Spain",
    "FI" => "Finland", "FR" => "France", "GE" => "Georgia", "DE" => "Germany", "GI" => "Gibraltar", "GB" => "Great Britain/England",
    "GR" => "Greece", "GL" => "Greenland", "GU" => "Guam (US)", "GT" => "Guatemala", "HN" => "Honduras", "HK" => "Hong Kong", "HU" => "Hungary",
    "IS" => "Iceland", "IN" => "India", "IR" => "Ireland", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica",
    "JP" => "Japan", "JO" => "Jordan", "KE" => "Kenya", "KR" => "Korea (South)", "KW" => "Kuwait", "LI" => "Liechtenstein", "LU" => "Luxembourg",
    "MO" => "Macau", "MX" => "Mexico", "MC" => "Monaco", "MZ" => "Mozambique", "NA" => "Namibia", "NL" => "Netherlands", "NZ" => "New Zealand",
    "NI" => "Nicaragua", "NO" => "Norway", "PA" => "Panama", "PY" => "Paraguay", "PE" => "Peru", "PL" => "Poland", "PT" => "Portugal",
    "PR" => "Puerto Rico (US)", "QA" => "Qatar", "RO" => "Romania", "RW" => "Rwanda", "SA" => "Saudi Arabia", "SC" => "Scotland",
    "SG" => "Singapore", "ZA" => "South Africa", "SE" => "Sweden", "CH" => "Switzerland", "TW" => "Taiwan", "TZ" => "Tanzania",
    "TR" => "Turkey", "UA" => "Ukraine", "AE" => "United Arab Emirates", "UK" => "United Kingdon", "VE" => "Venezuela", "YU" => "Yugoslavia",
    "ZR" => "Zaire", "ZM" => "Zambia", "ZW" => "Zimbabwe");
//$credit_cards = array(1 => "Visa", 2 => "MasterCard", 3 => "Discover", 4 => "American Express");
$credit_cards = array(1 => "Visa", 2 => "MasterCard", 3 => "Discover");

function htmlSafe($in_string) {
    return htmlspecialchars(stripslashes($in_string), ENT_QUOTES);
}

function expMonthDropdown($varname, $selected = "") {
    // Dropdown for credit card expiration values    
    if ($selected == "") {
        $nowinfo = getdate();
        $selected = $nowinfo['mon'];
    }

    $html = "<select id='$varname' name='$varname'>";

    for ($m = 1; $m < 13; $m++) {
        $m_val = str_pad($m, 2, "0", STR_PAD_LEFT);
        $html .= "<option value='$m_val'";

        if ($m_val == $selected) {
            $html .= " SELECTED";
        }

        $html .= ">" . $m_val . "</option>";
    }
    $html .= "</select>";

    return $html;
}

function expYearDropdown($varname, $selected = "") {
    // Dropdown for credit card expiration values
    $nowinfo = getdate();
    $nowyear = $nowinfo['year'];

    $html = "<select id='$varname' name='$varname'>";

    for ($y = $nowyear; $y < $nowyear + 10; $y++) {
        $y_val = $y;

        $html .= "<option value='$y_val'";

        if ($y_val == $selected) {
            $html .= " SELECTED";
        }

        $html .= ">" . $y_val . "</option>";
    }

    $html .= "</select>";

    return $html;
}

function currency($a_number) {
    $a_number = str_replace(",", ".", $a_number);
    $a_number = str_replace("$", "", $a_number);
    if ( ($a_number != null) && (validAmount($a_number)) ) {
        return number_format($a_number, 2, '.', '');
    }else
    {
        return "";
    }
}

function validAmount($amount) {
    if (preg_match("/^\d+(?:\.\d{0,2})?$/ ", $amount)){
        return true;
    } else {
        return false;
    }
}

function validEmail($email) {
    if (preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)) {
        return true;
    } else {
        return false;
    }
}

function allNumbers($input_str) { // FASTER?
    return preg_replace("/[\D]/", "", $input_str);
}

function returnNumericOptionFields($howManyOptions = 12, $startingAt = 2, $selectedAt = 2) {
    $options = "";
    for($i = $startingAt; $i <= $howManyOptions; $i++){
        $selected = "";
        if ($i == $selectedAt)
            $selected = " selected";
        $options .= "<option value='$i'$selected>$i</option>";
    }
    return $options;
}
?>