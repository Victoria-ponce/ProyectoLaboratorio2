<?php require_once INCLUDES . 'inc_header.php'; ?>

<?= Toast::flash() ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <?= $data['page_title'] ?? 'Nueva Subtarea' ?>
                </h4>
                <small class="text-muted">Tarea: <?= htmlspecialchars($data['todo']['task']) ?></small>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= URL ?>subtask/store">
                    <input type="hidden" name="todo_id" value="<?= $data['todo']['id'] ?>">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Subtarea *</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               placeholder="¿Qué necesitas hacer?" required autofocus>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= URL ?>todo" class="btn btn-outline-secondary me-md-2">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Guardar Subtarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>

