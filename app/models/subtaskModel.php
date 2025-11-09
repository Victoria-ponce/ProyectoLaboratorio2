<?php

class subtaskModel extends Model {
    
    protected $table = 'subtasks';
    protected $fillable = ['todo_id', 'title', 'completed'];
    
    public static function getByTodoId($todo_id) {
        $result = Db::query("SELECT * FROM subtasks WHERE todo_id = ? ORDER BY created_at ASC", [$todo_id]);
        return $result->fetchAll();
    }
    
    public static function toggleStatus($id) {
        Db::query("UPDATE subtasks SET completed = NOT completed WHERE id = ?", [$id]);
        return true;
    }
    
    public static function deleteByTodoId($todo_id) {
        Db::query("DELETE FROM subtasks WHERE todo_id = ?", [$todo_id]);
        return true;
    }
}
?>

