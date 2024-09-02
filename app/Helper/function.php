<?php 

function get_date($date, $format = "d/m/Y")
{
    if (empty($date)) {
        return '';
    }
    $date = str_replace('/', '-', $date);
    return date($format, strtotime($date));
}

function get_datetime($date, $format = "d/m/Y H:i:s A")
{
    if (empty($date)) {
        return '';
    }

    return date($format, strtotime($date));
}

function date_convert($date, $time = '00:00:00')
{
    if ($date) {
        $date = str_replace('/', '-', $date);
        return date('Y-m-d H:i:s', strtotime($date . ' ' . $time));
    }

    return null;
}
/* chuyển datetime từ d/m/Y H:i:s sang 'Y-m-d H:i:s' */
function datetime_convert($date_time)
{
    if ($date_time) {
        $date_time = str_replace('/', '-', $date_time);
        return date('Y-m-d H:i:s', strtotime($date_time));
    }

    return null;
}

function number_format_custom_dot($number, $decimals = 2)
{
    $number = number_format($number, $decimals); // Sử dụng number_format() ban đầu để định dạng số

    // Thay thế dấu chấm thành dấu phẩy
    $number = str_replace('.', ',', $number);

    return $number;
}
function number_format_custom_comma($number, $decimals = 2)
{
    $number = number_format($number, $decimals);

    // Thay thế dấu phẩy thành dấu chấm
    $number = str_replace(',', '.', $number);

    return $number;
}

function format_money($number, $decimals = 2)
{
    $formattedNumber = number_format($number, $decimals, '.', ','); // Sử dụng number_format() để định dạng số tiền

    // Thay thế dấu phẩy thành dấu chấm và dấu chấm thành dấu phẩy
    $formattedNumber = str_replace(',', '|', $formattedNumber);
    $formattedNumber = str_replace('.', ',', $formattedNumber);
    $formattedNumber = str_replace('|', '.', $formattedNumber);

    return $formattedNumber;
}
//pass có viết hoa, thường, số, ký tự đặc biệt ít nhất 8 ký tự
function check_password($password)
{
    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        return true;
    } else {
        return false;
    }
}

function profile()
{
  $profile = session()->get('profile');
  return $profile;
}
function createSlug($text, $maxLength = 20)
{
    // Bỏ dấu và chuyển đổi thành chữ thường
    $text = Str::slug($text, '_');

    // Giới hạn số lượng ký tự
    if (strlen($text) > $maxLength) {
        $text = substr($text, 0, $maxLength);
    }

    return $text;
}