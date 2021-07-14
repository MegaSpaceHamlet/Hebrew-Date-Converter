<?php

// Courtesy goes to David Greve for this code. https://www.david-greve.de/luach-code/jewish-php.html#gregoriantojewish

function isJewishLeapYar($y) {
    /* Apparently, if a Jewish year mod 19 equals any of these numbers, it's a leap year. */
    if ($y % 19 == 0 || $y % 19 == 3 || $y % 19 == 6 || $y % 19 == 8 || $y % 19 == 11 || $y % 19 == 14 || $y % 19 == 17) {
        return true;
    } else {
        return false;
    }
}

function getJewishMonthName($jm, $jy) {
    $jewishMonthNamesLeap = array(
        "Tishrei",
        "Cheshvon",
        "Kislev",
        "Teves",
        "Shvat",
        "Adar I",
        "Adar II",
        "Nissan",
        "Iyar",
        "Sivan",
        "Tammuz",
        "Menachem-Av",
        "Elul"
    );
    $jewishMonthNamesNonLeap = array(
        "Tishrei",
        "Cheshvon",
        "Kislev",
        "Teves",
        "Shvat",
        "Adar",
        "", // Must put empty value in. The 'jdtojewish' func returns 1-13 regardless of leap year status.
        "Nissan",
        "Iyar",
        "Sivan",
        "Tammuz",
        "Menachem-Av",
        "Elul"
    );
    if (isJewishLeapYar($jy)) {
        return $jewishMonthNamesLeap[ ($jm-1) ];
    } else {
        return $jewishMonthNamesNonLeap[ ($jm - 1) ];
    }
}

    $g_date_data = getdate();
    $g_weekday = $g_date_data['weekday'];
    $g_month_num = $g_date_data['mon']; // need this for Jewish conversion
    $g_month_name = $g_date_data['month'];
    $g_month_day = $g_date_data['mday'];
    $g_year = $g_date_data['year'];
    $g_date_string = $g_weekday . ', ' . $g_month_name . ' ' . $g_month_day . ', ' . $g_year;
    echo $g_month_day, $g_month_num, $g_year . "\n";
    $jdNumber = gregoriantojd($g_month_num, $g_month_day, $g_year); // convert gregorian into jd
    $jewishDate = jdtojewish( $jdNumber );
    list( $jMonth, $jDay, $jYear) = explode('/', $jewishDate);
    $jMonthName = getJewishMonthName( $jMonth, $jYear);
    $j_date_string = $jDay . ' ' . $jMonthName . ', ' . $jYear;
    echo '<h1 style="text-align: center;">' . $g_date_string . ' - ' . $j_date_string . '</h1>';