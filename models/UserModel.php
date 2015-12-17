<?php

require_once 'BaseModel.php';
require_once 'AdModel.php';

class UserModel extends BaseModel {
    protected static $table = 'users';

    /**
     * returns an array of AdModel objects that are all ads associated with the
     * user
     */
    public function getAds()
    {
        $ads = [];
        $id = $this->id;
        $query = "SELECT id FROM ads WHERE users_id = $id";
        $stmt = self::$dbc->prepare($query);
        $stmt->execute();
        $adIds = $stmt->fetchAll(PDO::FETCH_NUM);
        foreach ($adIds as $adId) {
            $ads[] = AdModel::find($adId[0]);
        }
        return $ads;

    }
}
