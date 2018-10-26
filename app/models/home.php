<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 7/20/18
 * Time: 11:18 PM
 */

class home
{

    public function getImagePathHead($id){
        $conn= new connect();
        $sql= "SELECT * FROM headerImage WHERE id = :id";
        $st = $conn->conn->prepare($sql);
        $st->bindValue( ":id", $id);
        $st->execute();
        $imgExtension=$st->fetch();
        $conn=null;
        return (IMAGE_PATH."/headerImage/".$id.'.'.$imgExtension['extension']);

    }

    public function getIntro()
    {
        $conn=new connect();
        $sql="SELECT * FROM homeIntro";
        $st=$conn->conn->prepare($sql);
        $st->execute();
        $headIntro=[];
        $headIntro=$st->fetchAll();
        foreach($headIntro as $i => $item)
        $headIntro[$i]['image']=IMAGE_PATH."/introImage/".$headIntro[$i]['image'];
        $conn=null;
        return($headIntro);
    }

    public function getAboutUs()
    {
        $conn=new connect();
        $sql="SELECT * FROM aboutUs";
        $st=$conn->conn->prepare($sql);
        $st->execute();
        $about=$st->fetchAll();
        $conn=null;
        return($about);
    }
    public function getContact()
    {
        $conn=new connect();
        $sql="SELECT * FROM contact";
        $st=$conn->conn->prepare($sql);
        $st->execute();
        $contact=$st->fetchAll();
        $conn=null;
        return($contact);
    }

    
}