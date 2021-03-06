<?php

require_once 'BaseModel.php';
require_once 'CategoryModel.php';

class AdModel extends BaseModel {
    protected static $table = 'ads';


    /**
     * find + all should return an instance with properties user and category
     * already populated
     */

    public static function find($id)
    {
        self::dbConnect();

        $query = "SELECT ads.id, ads.title, ads.price, ads.description, ads.image, ads.date_posted,
                    c.category_name as 'category', u.email as 'user' FROM ads
                    JOIN categories AS c ON ads.category_id = c.id
                    JOIN users AS u ON ads.users_id = u.id
                    WHERE ads.id = :id;";

        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        $instance = null;
        if ($result) {
            $instance = new static;
            foreach ($result as $key => $value) {
                $instance->$key = $value;
            }
        }

        return $instance;
    }
    /**
     * updates ad title, price, description, image, and date_posted
     * will NOT update user_id or category_id!
     */
    public function save()
    {
        if ($this->id != '') {
            // there is an id, so lets update

            // store id to use and put back later
            $id = $this->id;
            $this->id = '';

            $query = "UPDATE ads SET title = :title, price = :price, 
                        description = :description, image = :image, 
                        date_posted = :date_posted
                        WHERE id=$id";

            $stmt = static::$dbc->prepare($query);

            $stmt->bindValue(":title", $this->title, PDO::PARAM_STR);
            $stmt->bindValue(":price", $this->price, PDO::PARAM_STR);
            $stmt->bindValue(":description", $this->description, PDO::PARAM_STR);
            $stmt->bindValue(":image", $this->image, PDO::PARAM_STR);
            $stmt->bindValue(":date_posted", $this->date_posted, PDO::PARAM_STR);

            $stmt->execute();

            $this->id = $id;

        } else {
            // no id, lets insert
            $categoryId = CategoryModel::getCategoryId($this->category);

            $query = "INSERT INTO ads (title, price, description, image, 
                        date_posted, category_id, users_id) VALUES 
                        (:title, :price, :description, :image, :date_posted, 
                        :category_id, :users_id)";

            $stmt = static::$dbc->prepare($query);

            $stmt->bindValue(":title", $this->title, PDO::PARAM_STR);
            $stmt->bindValue(":price", $this->price, PDO::PARAM_STR);
            $stmt->bindValue(":description", $this->description, PDO::PARAM_STR);
            $stmt->bindValue(":image", $this->image, PDO::PARAM_STR);
            $stmt->bindValue(":date_posted", $this->date_posted, PDO::PARAM_STR);
            $stmt->bindValue(":category_id", $categoryId, PDO::PARAM_STR);
            $stmt->bindValue(":users_id", $this->users_id, PDO::PARAM_STR);

            $stmt->execute();

            $this->id = static::$dbc->lastInsertId();
        }
    }

    /**
     * returns a two dimensional array with one inner array representing one ad
     */
    public static function all()
    {
        self::dbConnect();

        $myQuery = "SELECT ads.id, ads.title, ads.price, ads.description, ads.image,
        ads.date_posted, c.category_name as 'category', u.email as 'user'
        FROM ads
        JOIN categories as c ON ads.category_id = c.id
        JOIN users as u ON ads.users_id = u.id";

        $stmt = self::$dbc->query($myQuery);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function getMostRecent($num = 3)
    {
        self::dbConnect();

        $myQuery = "SELECT ads.id, ads.title, ads.price, ads.description, ads.image,
        ads.date_posted, c.category_name as 'category', u.email as 'user'
        FROM ads
        JOIN categories as c ON ads.category_id = c.id
        JOIN users as u ON ads.users_id = u.id
        ORDER BY ads.id DESC
        LIMIT $num";

        $stmt = self::$dbc->query($myQuery);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * takes a search string and returns a two dimensional array containing
     * ad records matching the search string
     * Will first search the ad titles, but if no results come back, will search
     * the ad descriptions
     */
    public static function search($search)
    {
        self::dbConnect();

        $search = "%$search%";

        $query = "SELECT ads.id, ads.title, ads.price, ads.description, ads.image,
            ads.date_posted, c.category_name as 'category', u.email as 'user'
            FROM ads
            JOIN categories as c ON ads.category_id = c.id
            JOIN users as u ON ads.users_id = u.id
            WHERE ads.title LIKE :query";;

        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':query', $search, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)){
            $query = "SELECT ads.id, ads.title, ads.price, ads.description, ads.image,
                ads.date_posted, c.category_name as 'category', u.email as 'user'
                FROM ads
                JOIN categories as c ON ads.category_id = c.id
                JOIN users as u ON ads.users_id = u.id
                WHERE ads.description LIKE :query";;

            $stmt = self::$dbc->prepare($query);
            $stmt->bindValue(':query', $search, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        }

        return $result;
    }

}

