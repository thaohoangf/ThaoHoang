<?php
include_once 'Database.php';

class Model extends Database
{

    //constructor
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchResult($result)
    {
        $list = array();
        while($data = $result->fetch_assoc()){
            $list[] = $data;
        }
        return $list;
    }

    public function countFilter($table,$column,$condition)
    {
        $sql = "SELECT COUNT(*) as count FROM $table WHERE $column = $condition";
        $result = $this->cont->query($sql);
        $count = $result->fetch_assoc();
        return $count['count'];
    }


    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) as count FROM $table";
        $result = $this->cont->query($sql);
        $count = $result->fetch_assoc();
        return $count['count'];
    }
    //get all list table
    public function getAll($table, $select)
    {
        $query = "SELECT $select FROM $table";
        $result = $this->cont->query($query);
        return $this->fetchResult($result);
    }

    //get all limit
    public function getLimit($table,$offset,$step){
        $query = "SELECT * FROM $table LIMIT $offset,$step";
        $result = $this->cont->query($query);
        return $this->fetchResult($result);
    }

    //get all by id
    public function getBy($table,$select,$column,$condition)
    {
        $query = "SELECT $select FROM $table WHERE $column = '$condition'";
        $result = $this->cont->query($query);
        return $result;
    }

    //insert database
    public function insert($table,$infor)
    {
        $column = implode(',',array_keys($infor));
        $values = implode("','",array_values($infor));
        $values = "'$values'";
        $sql = "INSERT INTO $table($column) VALUES ($values)";
        $result = $this->cont->query($sql);
    }

    //update database
    public function update($table,$infor,$id)
    {
        $query = array();
        foreach($infor as $column => $values){
            $query[] = "$column = '$values'";
        }
        $update = implode(',',$query);
        $sql = "UPDATE $table SET $update WHERE id = '$id'";
        $result = $this->cont->query($sql);
    }

    //delete database
    public function delete($table,$id){
        $query = "DELETE FROM $table WHERE id = $id";
        $result = $this->cont->query($query);
    }

    //activate database
    public function activate($table, $id){
        $query = "UPDATE $table SET activate = 1 WHERE id = $id";
        $result = $this->cont->query($query);
        return $result;
    }

    //sort by column
    public function sortBy($table, $column,$order,$offset,$step)
    {
        $query = "SELECT * FROM $table ORDER BY $column $order LIMIT $offset,$step";
        $result = $this->cont->query($query);
        return $this->fetchResult($result);
    }

    public function countSearch($table, $column, $condition)
    {
        $sql = "SELECT COUNT(*) as count FROM $table WHERE $column LIKE '%$condition%'";
        $result = $this->cont->query($sql);
        $count = $result->fetch_assoc();
        return $count['count'];
    }

    public function searchLimit($table, $column,$search,$condition,$order,$offset,$step){
        $query = "SELECT * FROM $table WHERE $column LIKE '%$search%' ORDER BY $condition $order LIMIT $offset,$step ";
        $result = $this->cont->query($query);
        return $this->fetchResult($result);
    }

}
