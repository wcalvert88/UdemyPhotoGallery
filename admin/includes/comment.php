<?php 

class Comment extends Db_object {

    protected static $db_table = "comments";
    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body', 'timestamp');
    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $timestamp;
    
    public static function create_comment($photo_id, $author="John Doe", $body="", $timestamp) {
        if(!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();
            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = $body;
            $comment->timestamp = $timestamp;
            return $comment;
        } else {
            return false;
        }
    }

    public static function find_comments($photo_id=0) {
        global $database;

        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE photo_id = " . $database->escape($photo_id);
        $sql .= ".ORDER BY photo_id ASC";

        return self::find_by_query($sql);
    }
 


} // End of Class Comment






?>