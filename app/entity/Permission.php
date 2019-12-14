<?php


namespace app\entity;

class Permission
{
    // keep space between the ranks in case there is need for change
    // should get it's own db table with a column = a permission
    // but no time for now
    const Consumer = 0;
    const Advertiser = 5;
    const Administrator = 10;

    static private function check() {
        return isset($_SESSION["user"]);
    }

    static public function canUseAdminPage() {
        if(!self::check()) return false;
        return $_SESSION["user"]["permission"] >= self::Administrator;
    }

    static public function canCreateTravel() {
        if(!self::check()) return false;
        return $_SESSION["user"]["permission"] >= self::Administrator;
    }

    static public function canEditTravel() {
        if(!self::check()) return false;
        return $_SESSION["user"]["permission"] >= self::Administrator;
    }

    static public function canOrderTravel() {
        if(!self::check()) return false;
        return $_SESSION["user"]["permission"] >= self::Consumer;
    }

    static public function canUseMemberPage() {
        if(!self::check()) return false;
        return $_SESSION["user"]["permission"] >= self::Consumer;
    }
}