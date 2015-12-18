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

    public static function findByEmail($email)
    {
        self::dbConnect();

        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $userId =  $stmt->fetch()['id'];
        return self::find($userId);
    }
}
