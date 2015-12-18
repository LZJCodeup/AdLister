<?php

require_once 'BaseModel.php';

class CategoryModel extends BaseModel{
    protected static $table = 'categories';

    /**
     * will query the db and get all the categories, if the categoryName is not
     * in the categories table, it will insert it,
     * otherwise it will return the category id
     */
    public static function getCategoryId($categoryName)
    {
        $categories = CategoryModel::all();
        
        // find the category id
        foreach ($categories as $cat) {
            if ($categoryName == $cat['category_name']) {
                return $cat['id'];
            }
        }

        // category wasn't found, so we need to insert one
        $query = 'INSERT INTO categories (category_name) VALUES (:category_name)';
        $stmt = static::$dbc->prepare($query);
        $stmt->bindValue(":category_name", $categoryName, PDO::PARAM_STR);
        $stmt->execute();

        return self::getCategoryId($categoryName);
    }
}
