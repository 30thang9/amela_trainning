<?php
function divide($numerator, $denominator) {
    if ($denominator == 0) {
        throw new Exception("Mẫu số không thể là 0.");
    }
    return $numerator / $denominator;
}

try {
    $result = divide(10, 0);
    echo "Kết quả là: $result";
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
