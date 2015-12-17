<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel {
    protected static $table = 'users';

    /**
     * returns an array of AdModel objects that are all ads associated with the
     * user
     */
    public function getAds()
    {

    }
}
