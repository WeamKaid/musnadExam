<?php
class Comment {
    private $conn;
    private $table = 'comments';

    public $id;
    public $content_id;
    public $user_id;
    public $content;
    public $rating;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (content_id, user_id, content, rating) VALUES (:content_id, :user_id, :content, :rating)';

        $stmt = $this->conn->prepare($query);

        $this->content_id = htmlspecialchars(strip_tags($this->content_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->rating = htmlspecialchars(strip_tags($this->rating));

        $stmt->bindParam(':content_id', $this->content_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':rating', $this->rating);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id AND user_id = :user_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function belongsToUser() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id AND user_id = :user_id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function readAll($content_id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE content_id = :content_id ORDER BY created_at DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':content_id', $content_id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
