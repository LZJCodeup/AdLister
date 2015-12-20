<?php

class DateRangeException extends Exception { }

class Input
{
    //checks if an input is empty string or not
    public static function setAndNotEmpty($key)
    {
        if(isset($_REQUEST[$key]) && $_REQUEST[$key] != '')
        {
            return true;
        } else {
            throw new OutOfRangeException ('Empty Field Not Allowed!');
        }
    }

    // escape($input): returns the input as a safely escaped string.
    public static function escape($input)
    {
        return htmlspecialchars(strip_tags($input));
    }

    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    public static function has($key)
    {
        return (isset($_REQUEST[$key])) ? TRUE : FALSE;
    }

    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null)
    {
        return (self::has($key)) ? self::escape($_REQUEST[$key]) : NULL;
    }

    public static function getDate($key, $min = 'January 1, 1900', $max = 0)
    {
        $inputValue = self::get($key);
        if ($max == 0)
        {
            $max = date("Y-m-d");
        }
        try {
            $inputDateObject = new DateTime($inputValue);
        } catch (Exception $e) {
            throw new DomainException ("Invalid Date!");
        }

        $minDateObject = new DateTime($min);
        $maxDateObject = new DateTime($max);
        $minDateObjectFormatted = strtotime($minDateObject->format('Y-m-d'));
        $maxDateObjectFormatted = strtotime($maxDateObject->format('Y-m-d'));
        $inputDateObjectFormatted = strtotime($inputDateObject->format('Y-m-d'));
        
        if (($inputDateObjectFormatted < $minDateObjectFormatted) || ($inputDateObjectFormatted > $maxDateObjectFormatted))
        {
            throw new DateRangeException ("Must Be Between January 1, 1900 and today!");
        }
        return $inputDateObject;
    }

    public static function getString($key, $min = 1, $max = 200000)
    {
        $inputValue = self::get($key);
        if (!is_string($inputValue))
        {
            throw new InvalidArgumentException ("Expecting A String!");
        }
        if ((!is_numeric($min)) || (!is_numeric($max)))
        {
            throw new InvalidArgumentException ("Expecting A Numeric Value!");
        }
        if ($inputValue == "") 
        {
            throw new OutOfRangeException ("Empty Field Not Allowed!");
        }
        if ((strlen($inputValue) < $min) || (strlen($inputValue) > $max))
        {   
            throw new LengthException ("The Supplied String Length Must Be Between 1 and 50 Characters!");
        }
        if (($min < 1) || ($max > 200000))
        {
            throw new RangeException ("Out of Range (Expecting A Number Between 1 and 50)!");
        }
        return ($inputValue);
    }

    public static function getNumber($key, $min = 0, $max = 3800000000.00)
    {
        $inputValue = trim(self::get($key));
        if ((!is_numeric($min)) || (!is_numeric($max)))
        {
            throw new InvalidArgumentException ("Expecting A Numeric Value!");
        }
        if ($inputValue == "") 
        {
            throw new OutOfRangeException ("Empty Field Not Allowed!");
        }
        if (!is_numeric($inputValue)) {
            throw new DomainException ("Expecting A Numeric Value!");
        }
        if (($inputValue < $min) || ($inputValue > $max))
        {
            throw new RangeException ("Out Of Range (Expecting A Number Between 0 and 3.8 billion)!");
        }
        return floatval($inputValue);
    }

    // returns the password hashed
    public static function getPassword($key)
    {
        // verifiy the password meets requirements - TODO
        //six characters long
        //combination of letters, numbers, and symbols
        //lowercase and uppercase
        //cannot contain your name, last name, or email
        //hash the password
        return password_hash($key, PASSWORD_DEFAULT);
    }

    public static function getImage()
    {   //are the named exceptions that I am throwing ok???
        $targetDirectory = "../public/uploads/";  //set the directory
        $targetFile = $targetDirectory . basename($_FILES['fileToUpload']['name']);  //file to save
        $imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION); //returns png, jpg, etc.

        // Check if image file is a actual image or fake image; if fake throw an exception
        if(isset($_POST['upload-image'])) {
            $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
            if($check === false) {
                throw new UnexpectedValueException ("File Is Not An Image!");
            }
        }
        //"File is an image - located under $check['mime']

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" )
        {
            throw new UnexpectedValueException ("Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
        }

        // Check if file already exists
        if (file_exists($targetFile))
        {
            throw new UnexpectedValueException ("Sorry, file already exists!");
        }

        // Check file size - 1000000 Bytes (1 MB)
        if ($_FILES['fileToUpload']['size'] > 1000000)
        {
            throw new RangeException ("Sorry, your file is too large!");
        }        
    
        if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile))
        {
            throw new LogicException ("Sorry, there was an error uploading your file!");
        }
        // basename( $_FILES["fileToUpload"]["name"]) has been uploaded
        //return $targetFile to get path
        return ("/uploads/" . $_FILES['fileToUpload']['name']);
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
