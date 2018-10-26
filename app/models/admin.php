<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 10/9/18
 * Time: 11:53 PM
 */

class admin extends home
{
    public function changeHeaderImg($id,$extension){
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE headerImage SET  extension=:extension WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":extension", $extension);
        $st->bindValue( ":id", $id);
        $st->execute();
        $conn = null;
    }
    public function updateIntro($data) {

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE homeIntro SET title=:title, content=:content, image=:image WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":title", $data['postTitle']);
        $st->bindValue( ":content", $data['postSum']);
        $st->bindValue( ":image", $data['postImg']);
        $st->bindValue( ":id", $data['postID']);
        $st->execute();
        $conn = null;
    }
    // update aboutUs
    public function updateAbout($data) {

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE aboutUs SET header=:header, keywords=:keywords, content=:content WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":header", $data['postTitle']);
        $st->bindValue( ":keywords", $data['postSum']);
        $st->bindValue( ":content", $data['postCon']);
        $st->bindValue( ":id", $data['postID']);
        $st->execute();
        $conn = null;
    }

    public function updateContact($data) {

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE contact SET title=:title, content=:content WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":title", $data['postTitle']);
        $st->bindValue( ":content", $data['postCon']);
        $st->bindValue( ":id", $data['postID']);
        $st->execute();
        $conn = null;
    }

    public function loginInfo($user)
    {
        $conn= new connect();
        $sql= "SELECT * FROM user WHERE username = :user";
        $st = $conn->conn->prepare($sql);
        $st->bindValue( ":user", $user);
        $st->execute();
        $info=$st->fetch(PDO::FETCH_ASSOC);
        $conn=null;
        return($info);
    }
    public function updateAdmin($data)
    {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sql = "UPDATE user SET username=:username, password=:pass";
            $st = $conn->prepare($sql);
            $st->bindValue(":username", $data['username']);
            $st->bindValue(":pass", $data['hashPass']);
            $st->execute();
        }
        catch (\Exception $e) {

            $error = 'the action was not performed unexpected error';
            return $error;
        }
    }

}