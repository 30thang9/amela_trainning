<?php

class UserModel {
    public function getUser($id) {
        $fakeData = array(
            123 => "The Huong, 22 years old, email: huong@gmail.com",
            456 => "Dat, 25 years old, email: dat@gmail.com",
            789 => "Hung, 35 years old, email: hung@gmail.com"
        );
        if (array_key_exists($id, $fakeData)) {
            return $fakeData[$id];
        } else {
            return "Không tìm thấy thông tin người dùng với ID $id";
        }
    }
}

?>

