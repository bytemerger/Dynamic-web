<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 9/27/18
 * Time: 7:17 PM
 */

class blog
{
    public static function getCat()
    {
        $conn= new connect();
        $sql= "SELECT * FROM category";
        $st = $conn->conn->prepare($sql);
        $st->execute();
        $cat=$st->fetchAll(PDO::FETCH_COLUMN, 1);
        return($cat);

    }
    // get category columns
    public static function getCategoryVar($name)
    {
        $conn= new connect();
        $sql= "SELECT * FROM category where name=:name";
        $st = $conn->conn->prepare($sql);
        $st->bindValue( ":name", $name);
        $st->execute();
        $cat=$st->fetchAll(PDO::FETCH_ASSOC);
        return($cat);

    }

    public static function getById($id){
        $conn= new connect();
        $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM posts WHERE id = :id";
        $st = $conn->conn->prepare( $sql );
        $st->bindValue( ":id", $id);
        $st->execute();
        $post=$st->fetch();
        $post['image']=IMAGE_PATH."/postImage/". $post['id'] .$post['image'];
        return($post);
    }

    public static function getList($numRows)
    {
        $conn = new connect();
        $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM posts
            ORDER BY  publicationDate DESC LIMIT :num";
        $st=$conn->conn->prepare($sql);
        $st->bindValue( ":num", $numRows, PDO::PARAM_INT );
        $st->execute();
        $post=$st->fetchAll();
        foreach($post as $i => $item)
            $post[$i]['image']=IMAGE_PATH."/postImage/". $post[$i]['id'] .$post[$i]['image'];
        return($post);

    }

    public static function getCatPost($cat)
    {
        $conn = new connect();
        $sql = "    SELECT id, publicationDate, title, summary, image
                      FROM posts INNER JOIN postCat
                        ON posts.id = postCat.postId
                        WHERE catName = :cat";
        $st=$conn->conn->prepare($sql);
        $st->bindValue( ":cat", $cat);
        $st->execute();
        $post=$st->fetchAll();
        foreach($post as $i => $item)
            $post[$i]['image']=IMAGE_PATH."/postImage/". $post[$i]['id'] .$post[$i]['image'];
        return($post);
    }

    public static function getViewCat($id)
    {
        $conn = new connect();
        $sql = "SELECT * FROM postCat WHERE postId = :id";
        $st=$conn->conn->prepare($sql);
        $st->bindValue( ":id", $id);
        $st->execute();
        $post=$st->fetchAll(PDO::FETCH_COLUMN, 0);
        return($post);
    }

    public static function deleteCat($cat)
    {
        $conn = new connect();
        $conn->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->conn->beginTransaction();
        try {
            //get all posts id with the category
            $sql = "SELECT * FROM postCat WHERE catName = :cat";
            $st = $conn->conn->prepare($sql);
            $st->bindValue(":cat", $cat);
            $st->execute();
            $post = $st->fetchAll(PDO::FETCH_COLUMN, 1);

            // delete category from post and category table
            $stmt = $conn->conn->prepare('DELETE FROM postCat WHERE catName = :cat');
            $stmt->execute(array(':cat' => $cat));
            //delete category from categories tables
            $stmt = $conn->conn->prepare('DELETE FROM category WHERE name = :cat');
            $stmt->execute(array(':cat' => $cat));

            //get the new post id after category has been deleted
            $sql = "SELECT * FROM postCat";
            $st = $conn->conn->prepare($sql);
            $st->execute();
            $cat = $st->fetchAll(PDO::FETCH_COLUMN, 1);

            // check if the old id is in the new id list
            //if not in the list insert a new category with id(this) and category general
            foreach ($post as $post1) {
                if (!in_array($post1, $cat)) {
                    $general='general';
                    $sql = "INSERT INTO `postCat`(catName, postId) VALUES (?, ?)";
                    $st = $conn->conn->prepare($sql);
                    $st->bindParam(1, $general);
                    $st->bindParam(2, $post1);
                    $st->execute();
                }
            }
            $conn->conn->commit();
        }
        catch (\Exception $e) {
            $conn->conn->rollback();

        }
    }

    public static function deletePost($id)
    {
        $conn = new connect();
        $conn->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->conn->beginTransaction();
        try {

            $stmt = $conn->conn->prepare('DELETE FROM posts WHERE  id = :id');
            $stmt->execute(array(':id' => $id));

            $stmt = $conn->conn->prepare('DELETE FROM postCat WHERE postId = :id');
            $stmt->execute(array(':id' => $id));

            $conn->conn->commit();
        }
        catch (\Exception $e) {
            $conn->conn->rollback();

        }

    }
    public static function addPost($data)
    {
        $conn = new connect();
        $conn->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->conn->beginTransaction();
        try {
            $sql = "INSERT INTO posts ( publicationDate, title, summary, content, image ) VALUES ( :pubDate, :title, :summary, :content, :image )";
            $st = $conn->conn->prepare($sql);
            $st->bindValue(":pubDate", $data['postDate']);
            $st->bindValue(":title", $data['postTitle']);
            $st->bindValue(":summary", $data['postSum']);
            $st->bindValue(":content", $data['postCont']);
            $st->bindValue(":image", $data['postImg']);
            $st->execute();
            $id = $conn->conn->lastInsertId();

            foreach ($data['postCat'] as $cat) {
                $sql = "INSERT INTO postCat ( catName, postId) VALUES ( :cat , :id)";
                $st = $conn->conn->prepare($sql);
                $st->bindValue(":cat", $cat);
                $st->bindValue(":id", $id);
                $st->execute();
            }
            $conn->conn->commit();
        }
        catch (\Exception $e) {
            $conn->conn->rollback();
        }
        return $id;
    }

    public static function editPost($data)
    {
        $conn = new connect();
        $conn->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->conn->beginTransaction();
        try {
            $sql = "UPDATE posts SET publicationDate=:pubDate, title=:title, summary=:summary, content=:content, image=:image where id = :id";
            $st = $conn->conn->prepare($sql);
            $st->bindValue(":id", $data['postId']);
            $st->bindValue(":pubDate", $data['postDate']);
            $st->bindValue(":title", $data['postTitle']);
            $st->bindValue(":summary", $data['postSum']);
            $st->bindValue(":content", $data['postCont']);
            $st->bindValue(":image", $data['postImg']);
            $st->execute();


            $stmt = $conn->conn->prepare('DELETE FROM postCat WHERE postId = :id');
            $stmt->execute(array(':id' => $data['postId']));


            foreach ($data['postCat'] as $cat) {
                $sql = "INSERT INTO postCat ( catName, postId) VALUES ( :cat , :id)";
                $st = $conn->conn->prepare($sql);
                $st->bindValue(":cat", $cat);
                $st->bindValue(":id", $data['postId']);
                $st->execute();
            }
            $conn->conn->commit();
        }
        catch (\Exception $e) {
            $conn->conn->rollback();
            $error ='the action was not performed unexpected error';
            return $error;
        }

    }

    public static function addCat($data)
    {
        $conn = new connect();
        $sql = "INSERT INTO category ( name, description ) VALUES ( :title, :desc)";
        $st = $conn->conn->prepare($sql);
        $st->bindValue(":title", $data['postTitle']);
        $st->bindValue(":desc", $data['postDesc']);
        $st->execute();
    }

    public static function editCat($data)
    {
        $conn = new connect();
        $conn->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->conn->beginTransaction();
        try {
            $sql = "UPDATE category SET name=:newname, description=:description where name = :oldname";
            $st = $conn->conn->prepare($sql);
            $st->bindValue(":oldname", $data['name']);
            $st->bindValue(":newname", $data['postTitle']);
            $st->bindValue(":description", $data['postDesc']);
            $st->execute();

            $sql = "UPDATE postCat SET catName=:newname where catName = :oldname";
            $st = $conn->conn->prepare($sql);
            $st->bindValue(":oldname", $data['name']);
            $st->bindValue(":newname", $data['postTitle']);
            $st->execute();

            $conn->conn->commit();

        } catch (\Exception $e) {
            $conn->conn->rollback();
            $error = 'the action was not performed unexpected error';
            return $error;
        }

    }

}