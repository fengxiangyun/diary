<?php
class DiaryBookNamespace {
    
    public static function getUserById($id) {
        $id = (int)$id;
        if ($id <= 0) {
            return '';
        }
        $sql = "SELECT * FROM `diary_book` WHERE `id` = '" . $id . "'";
        return DBMysqli::getInstance()->getRow($sql);
    }
}