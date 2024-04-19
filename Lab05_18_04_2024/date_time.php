<?php
// Lấy thời gian hiện tại
$current_time = time();

// Sử dụng mktime() để tạo thời gian cụ thể
$specific_time = mktime(12, 30, 0, 4, 9, 2024);

// Định dạng thời gian
$formatted_time = date("Y-m-d H:i:s", $current_time);

// Biến đổi thời gian từ string sang timestamp
$time_string = "2024-04-09 15:30:00";
$new_time = strtotime($time_string);

// Cộng thời gian
$new_time_plus_one_hour = strtotime('+1 hour', $new_time);

// Trừ thời gian
$new_time_minus_one_day = strtotime('-1 day', $new_time);

if ($new_time_plus_one_hour > $new_time) {
    echo "New time is greater than original time.";
}
