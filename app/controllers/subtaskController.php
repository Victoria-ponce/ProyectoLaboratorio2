<?php

class subtaskController extends Controller {
    
    protected $title = 'Subtareas';
    
    function add() {
        if (!isset($_GET['todo_id']) || !is_numeric($_GET['todo_id'])) {
            $this->redirectWithMessage('todo', 'ID de tarea inválido', 'danger');
            return;
        }
        
        $todo = todoModel::find($_GET['todo_id']);
        if (!$todo) {
            $this->redirectWithMessage('todo', 'Tarea no encontrada', 'danger');
            return;
        }
        
        $data = [
            'page_title' => 'Agregar Subtarea',
            'todo' => $todo
        ];
        
        View::render('addSubtask', $data);
    }
    
    function store() {
        if (!isset($_POST['todo_id']) || !is_numeric($_POST['todo_id'])) {
            $this->redirectWithMessage('todo', 'ID de tarea inválido', 'danger');
            return;
        }
        
        if (!$this->validatePost(['title'])) {
            $this->redirectWithMessage('subtask/add?todo_id=' . $_POST['todo_id'], 'Debe ingresar un título', 'warning');
            return;
        }
        
        $subtaskData = [
            'todo_id' => $_POST['todo_id'],
            'title' => trim($_POST['title']),
            'completed' => 0
        ];
        
        subtaskModel::create($subtaskData);
        $this->redirectWithMessage('todo', 'Subtarea agregada', 'success');
    }
    
    function edit() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('todo', 'ID inválido', 'danger');
            return;
        }
        
        $subtask = subtaskModel::find($_GET['id']);
        if (!$subtask) {
            $this->redirectWithMessage('todo', 'Subtarea no encontrada', 'danger');
            return;
        }
        
        $todo = todoModel::find($subtask['todo_id']);
        
        $data = [
            'page_title' => 'Editar Subtarea',
            'subtask' => $subtask,
            'todo' => $todo
        ];
        
        View::render('editSubtask', $data);
    }
    
    function update() {
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            $this->redirectWithMessage('todo', 'ID inválido', 'danger');
            return;
        }
        
        if (!$this->validatePost(['title'])) {
            $this->redirectWithMessage('subtask/edit?id=' . $_POST['id'], 'Debe ingresar un título', 'warning');
            return;
        }
        
        $subtask = subtaskModel::find($_POST['id']);
        if (!$subtask) {
            $this->redirectWithMessage('todo', 'Subtarea no encontrada', 'danger');
            return;
        }
        
        $subtaskData = [
            'title' => trim($_POST['title'])
        ];
        
        subtaskModel::update($_POST['id'], $subtaskData);
        $this->redirectWithMessage('todo', 'Subtarea actualizada', 'success');
    }
    
    function toggle() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('todo', 'ID inválido', 'danger');
            return;
        }
        
        $subtask = subtaskModel::find($_GET['id']);
        if (!$subtask) {
            $this->redirectWithMessage('todo', 'Subtarea no encontrada', 'danger');
            return;
        }
        
        subtaskModel::toggleStatus($_GET['id']);
        $this->redirectWithMessage('todo', 'Subtarea actualizada', 'info');
    }
    
    function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('todo', 'ID inválido', 'danger');
            return;
        }
        
        $subtask = subtaskModel::find($_GET['id']);
        if (!$subtask) {
            $this->redirectWithMessage('todo', 'Subtarea no encontrada', 'danger');
            return;
        }
        
        subtaskModel::delete($_GET['id']);
        $this->redirectWithMessage('todo', 'Subtarea eliminada', 'info');
    }
}
?>

