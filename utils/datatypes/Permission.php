<?php

class Permission extends SplEnum {
    const __default = self::Consumer;

    // keep space between the ranks in case there is need for change
    // should get it's own db table with a column = a permission
    // but no time for now
    const Consumer = 0;
    const Advertiser = 5;
    const Administrator = 10;
}