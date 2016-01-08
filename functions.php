<?php
// all basic functions
	function mysql_prep( $value )
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysql_real_escape_string");// i.e PHP >= v4.3.0
		
		if($new_enough_php)
		{//PHP v4.3.0 or higher 
			//undo any magic qoute effects so mysql_real_escape_string can do the work
			if($magic_qoutes_active)
			{
			$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		}
		else
		{//before PHP v4.3.0
		// if magic qoutes aren't already on then add slashes manually
		if(!magic_qoutes_active)
		{
		$value = addslashes($value);
		}
		//f magic qoutes are active, then the slashes already exists	
		}
		return $value;
	}
	
		function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
	
	function confirm_query($result_set)
	{
	if(!$result_set)
					{
						die("Database query failed: ".mysql_error());
					}
					
	}

	function get_all_users()
	{
		$query = "SELECT * FROM users 
				ORDER BY 'username' ASC";
				$user_set = mysql_query($query);
				confirm_query($user_set);
				return $user_set;
	}
        function get_all_mods()
	{
		$query = "SELECT * FROM users
				 WHERE user_level = 2 ORDER BY 'username' ASC";
				$user_set = mysql_query($query);
				confirm_query($user_set);
				return $user_set;
	}
	
	function get_all_items()
	{
		$query = "SELECT * FROM tems 
				ORDER BY 'itemid' DESC";
				$item_set = mysql_query($query);
				confirm_query($item_set);
				return $item_set;
	
	}
	function get_all_files()
	{
		$query = "SELECT * FROM files";
				$file_set = mysql_query($query);
				confirm_query($file_set);
				return $file_set;
	
	}
	function get_all_cat()
	{
		$query = "SELECT * FROM categories";
				$cat_set = mysql_query($query);
				confirm_query($cat_set);
				return $cat_set;
	
	}
	
	function get_topics_by_id($topic_id)
	{
		$query = "SELECT * FROM topics WHERE topic_cat='$topic_id'";
				$topic_set = mysql_query($query);
				confirm_query($topic_set);
				return $topic_set;
	
	}


	function get_posts_by_id($topic_id)
	{
		$query = "SELECT * FROM posts WHERE post_topic='$topic_id'";
				$post_set = mysql_query($query);
				confirm_query($post_set);
				return $post_set;

	}


        
	
	 function count_all_cat()
        {
	  $sql = "SELECT COUNT(*) FROM categories";
           $cat_set = mysql_query($sql);
            confirm_query($cat_set);
            $cat_row = mysql_fetch_array($cat_set);
            return array_shift($cat_row);
	}
         function count_all_topic_by_id($topic_id)
        {
	  $sql = "SELECT COUNT(*) FROM topics WHERE topic_cat={$topic_id}";
           $topic_set = mysql_query($sql);
            confirm_query($topic_set);
            $topic_row = mysql_fetch_array($topic_set);
            return array_shift($topic_row);
	}
          function count_all_post($topic_id)
        {
	  $sql = "SELECT COUNT(*) FROM posts WHERE post_topic={$topic_id}";
           $topic_set = mysql_query($sql);
            confirm_query($topic_set);
            $topic_row = mysql_fetch_array($topic_set);
            return array_shift($topic_row);
	}
	
class page
{
    protected static $db_fields=array('cat_id', 'cat_name', 'cat_description','cat','by');
    public $cat_id;
	public $cat_name;
	public $cat_description;

    function find_by_sql($sql="") {

            $result_set = mysql_query($sql);
            $object_array = array();
            while ($row = mysql_fetch_array($result_set)) {
                $object_array[] = self::instantiate($row);
            }
            return $object_array;

        }
	
	function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];

		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
         function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

         function attributes() {
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
}
	function createThumbnail($filename) {

	require 'thumb_config.php';

	if(preg_match('/[.](jpg)$/', $filename)) {
		$im = imagecreatefromjpeg($path_to_image_directory . $filename);
	} else if (preg_match('/[.](gif)$/', $filename)) {
		$im = imagecreatefromgif($path_to_image_directory . $filename);
	} else if (preg_match('/[.](png)$/', $filename)) {
		$im = imagecreatefrompng($path_to_image_directory . $filename);
	}

	$ox = imagesx($im);
	$oy = imagesy($im);

	$nx = $final_width_of_image;
	$ny = floor($oy * ($final_width_of_image / $ox));

	$nm = imagecreatetruecolor($nx, $ny);

	imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);

	if(!file_exists($path_to_thumbs_directory)) {
	  if(!mkdir($path_to_thumbs_directory)) {
           die("There was a problem. Please try again!");
	  }
       }

	imagejpeg($nm, $path_to_thumbs_directory . $filename);
	$tn = '<img src="' . $path_to_thumbs_directory . $filename . '" alt="image" />';
	$tn .= '<br />Congratulations. Your file has been successfully uploaded, and a 	  thumbnail has been created.';
	echo $tn;
        

        }
        function get_all_posts()
	{
		$query = "SELECT pid,pimage,ptitle,created FROM posts
				ORDER BY created DESC";
				$titleset = mysql_query($query);
				confirm_query($titleset);
				return $titleset;
	}
	function get_all_months()
	{
		$query="SELECT * FROM navigation
		ORDER BY monthid ASC";
		$monthset=mysql_query($query);
		confirm_query($monthset);
		return $monthset;
	}

		function get_post_by_id($pid)
	{
	$query = "SELECT * ";
	$query .= "FROM posts ";
	$query .= "WHERE pid=" . $pid ." ";
	$query .= "LIMIT 1";
	$post_set = mysql_query($query);
	confirm_query($post_set);
	if($post == mysql_fetch_array($post_set))
	{
	return $post;
	}
	else
	{
	return NULL;
	}
	}

	function formatImage($img=NULL)
	{
		if(isset($img))
		{
			return '<img src="'.$img.'" border="5" border-color="red" />';
		}
		else
		{
			return NULL;
		}
	}


	
	
	?>