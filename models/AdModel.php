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
            // $instance->attributes = $result;
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
            echo "no id!\n";

            $categoryId = $this->getCategoryId($this->category);
            echo "--------------------\ninside save()\nvar dump categoryId...\n";
            var_dump($categoryId);


            // ad category
            // query the db and grab all the categories
            // if $ad->category is in the categories table, insert the category id
            // else insert a new category into the db, get its id and set the category id
            // equal to the new id

            $query = "INSERT INTO ads (title, price, description, image, 
                        date_posted, category_id, users_id) VALUES 
                        (:title, :price, :description, :image, :date_posted, 
                        :category_id, :users_id)";

            // $stmt = static::$dbc->prepare($query);

            // $stmt->bindValue(":$key", $value, PDO::PARAM_STR);

            // $stmt->execute();


        }
    }

    /**
     * will query the db and get all the categories, if the categoryName is not
     * in the categories table, it will insert it,
     * otherwise it will return the category id
     */
    private function getCategoryId($categoryName)
    {
        echo 'getCategoryId called!' . PHP_EOL;
        $categories = CategoryModel::all();
        
        // find the category id
        foreach ($categories as $cat) {
            if ($categoryName == $cat['category_name']) {
                return $cat['id'];
            }
        }

        // category wasn't found, so we need to insert one
        echo "inserting category...";
        $query = 'INSERT INTO categories category_name, VALUE :category_name;';
        $stmt = static::$dbc->prepare($query);
        $stmt->bindValue(":category_name", $categoryName, PDO::PARAM_STR);
        $stmt->execute();

        return $this->getCategoryId($categoryName);
    }

}

