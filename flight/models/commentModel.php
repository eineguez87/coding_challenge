<?php

class CommentModel
{
    private $db;
    private $table = 'comments';

    public function __construct()
    {
        $this->db = Flight::db();
    }

    /**
     * DB call to get all comments
     * @return array
     */
    public function getComments()
    {
        $result = $this->db->query("SELECT * FROM {$this->table} ORDER BY inserted_at DESC");
        $results = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }

        return $results;
    }

    /**
     * DB call to insert a comment.
     * @param $data
     * @return mixed
     */
    public function addComment($data)
    {
        $sql = "INSERT INTO {$this->table} (name, comment, parent_id) VALUES (:name, :comment, :parent_id)";
        $stmt= $this->db->prepare($sql);
        $stmt->execute($data);
        $id = $this->db->lastInsertId();

        return $this->db->query("SELECT * FROM {$this->table} WHERE id = {$id} LIMIT 1")->fetch(PDO::FETCH_ASSOC);

    }
}