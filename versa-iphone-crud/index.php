<?php include('conexao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<title>Controle de iPhones - Versa iPhone</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    body {
        background-color: #f8f9fa;
        font-size: 1.2rem;
        padding-bottom: 40px;
    }

    h1 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    /* Desktop tabela normal */
    .table-container {
        display: block;
    }

    /* Cards mobile - escondido no desktop */
    .card-list {
        display: none;
    }

    /* Mobile */
    @media (max-width: 768px) {
        body {
            font-size: 1.3rem;
        }
        h1 {
            font-size: 1.6rem;
        }

        /* Esconder tabela no mobile */
        .table-container {
            display: none;
        }

        /* Mostrar cards no mobile */
        .card-list {
            display: block;
        }

        .card-item {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 0.1);
        }

        .card-item > div {
            margin-bottom: 0.5rem;
        }

        .card-item label {
            font-weight: 600;
            display: inline-block;
            width: 120px;
        }

        select.form-select-sm,
        button.badge {
            width: auto;
            font-size: 1rem;
        }

        button.badge {
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            cursor: pointer;
        }
    }

    /* Badge colors */
    .bg-pendente {
        background-color: #ffc107 !important;
        color: #212529 !important;
    }

    .bg-concluido {
        background-color: #198754 !important;
        color: white !important;
    }
</style>
</head>
<body>

<div class="container mt-4 mb-5">
    <h1 class="text-center">📱 Controle de iPhones - Versa iPhone</h1>

    <!-- FILTROS -->
    <form method="GET" class="row g-2 mb-4">
        <div class="col-6 col-md-3">
            <select name="local" class="form-select" aria-label="Filtro Local">
                <option value="">Todos os Locais</option>
                <option value="Versa" <?= isset($_GET['local']) && $_GET['local'] == 'Versa' ? 'selected' : '' ?>>Versa</option>
                <option value="Alex" <?= isset($_GET['local']) && $_GET['local'] == 'Alex' ? 'selected' : '' ?>>Alex</option>
                <option value="Bin" <?= isset($_GET['local']) && $_GET['local'] == 'Bin' ? 'selected' : '' ?>>Bin</option>
            </select>
        </div>
        <div class="col-6 col-md-3">
            <select name="situacao" class="form-select" aria-label="Filtro Situação">
                <option value="">Todas as Situações</option>
                <option value="Pendente" <?= isset($_GET['situacao']) && $_GET['situacao'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="Concluído" <?= isset($_GET['situacao']) && $_GET['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
            </select>
        </div>
        <div class="col-12 col-md-3">
            <button type="submit" class="btn btn-primary w-100">🔍 Filtrar</button>
        </div>
        <div class="col-12 col-md-3">
            <a href="index.php" class="btn btn-secondary w-100">❌ Limpar Filtros</a>
        </div>
    </form>

    <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
        <a href="adicionar.php" class="btn btn-success flex-grow-1 flex-sm-grow-0">➕ Adicionar Aparelho</a>
    </div>

    <?php
    // FILTROS RECEBIDOS
    $filtro_local = isset($_GET['local']) ? $_GET['local'] : '';
    $filtro_situacao = isset($_GET['situacao']) ? $_GET['situacao'] : '';

    // QUERY COM FILTROS
    $sql = "SELECT * FROM aparelhos WHERE 1";

    if ($filtro_local != '') {
        $sql .= " AND local = '" . mysqli_real_escape_string($conexao, $filtro_local) . "'";
    }

    if ($filtro_situacao != '') {
        $sql .= " AND situacao = '" . mysqli_real_escape_string($conexao, $filtro_situacao) . "'";
    }

    $sql .= " ORDER BY id DESC";

    $resultado = mysqli_query($conexao, $sql);
    ?>

    <!-- Tabela desktop -->
    <div class="table-container table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>ID Aparelho</th>
                    <th>Modelo</th>
                    <th>Descrição</th>
                    <th>Local</th>
                    <th>Situação</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['id_aparelho']}</td>";
                echo "<td>{$row['modelo']}</td>";
                echo "<td>{$row['descricao']}</td>";

                // Desktop table local select
                echo "<td>
                    <form class='d-inline'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <select name='local' class='form-select form-select-sm' data-ajax='true' aria-label='Local do aparelho'>
                            <option ".($row['local'] == 'Versa' ? 'selected' : '').">Versa</option>
                            <option ".($row['local'] == 'Alex' ? 'selected' : '').">Alex</option>
                            <option ".($row['local'] == 'Bin' ? 'selected' : '').">Bin</option>
                        </select>
                    </form>
                </td>";

                $badgeClass = ($row['situacao'] == 'Pendente') ? 'bg-pendente' : 'bg-concluido';

                // Situation button form
                echo "<td>
                    <form class='d-inline' data-ajax='true'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='hidden' name='situacao' value='".($row['situacao'] == 'Pendente' ? 'Concluído' : 'Pendente')."'>
                        <button type='submit' class='badge {$badgeClass}' aria-label='Alterar situação'>
                            {$row['situacao']}
                        </button>
                    </form>
                </td>";

                echo "<td>{$row['data_cadastro']}</td>";

                echo "<td>
                        <a href='editar.php?id={$row['id']}' class='btn btn-primary btn-sm mb-1 w-100'>Editar</a>
                        <a href='deletar.php?id={$row['id']}' class='btn btn-danger btn-sm w-100' onclick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Cards mobile -->
    <div class="card-list">
        <?php
        mysqli_data_seek($resultado, 0); // Resetar resultado para reutilizar no mobile
        while ($row = mysqli_fetch_assoc($resultado)) {
            $badgeClass = ($row['situacao'] == 'Pendente') ? 'bg-pendente' : 'bg-concluido';
            echo "<div class='card-item'>";
            echo "<div><label>ID:</label> {$row['id']}</div>";
            echo "<div><label>ID Aparelho:</label> {$row['id_aparelho']}</div>";
            echo "<div><label>Modelo:</label> {$row['modelo']}</div>";
            echo "<div><label>Descrição:</label> {$row['descricao']}</div>";

            // Mobile cards local select
            echo "<div><label>Local:</label>
                <form class='d-inline'>
                    <input type='hidden' name='id' value='{$row['id']}'>

                    <select name='local' class='form-select form-select-sm d-inline w-auto' data-ajax='true' aria-label='Local do aparelho'>
                        <option ".($row['local'] == 'Versa' ? 'selected' : '').">Versa</option>
                        <option ".($row['local'] == 'Alex' ? 'selected' : '').">Alex</option>
                        <option ".($row['local'] == 'Bin' ? 'selected' : '').">Bin</option>
                    </select>
                </form>
            </div>";

            // Situation button form
            echo "<div><label>Situação:</label>
                <form class='d-inline' data-ajax='true'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='situacao' value='".($row['situacao'] == 'Pendente' ? 'Concluído' : 'Pendente')."'>
                    <button type='submit' class='badge {$badgeClass}' aria-label='Alterar situação'>
                        {$row['situacao']}
                    </button>
                </form>
            </div>";

            echo "<div><label>Data:</label> {$row['data_cadastro']}</div>";

            echo "<div class='mt-2'>
                    <a href='editar.php?id={$row['id']}' class='btn btn-primary btn-sm mb-1 w-100'>Editar</a>
                    <a href='deletar.php?id={$row['id']}' class='btn btn-danger btn-sm w-100' onclick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a>
                  </div>";

            echo "</div>";
        }
        ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle situacao updates
    const situacaoForms = document.querySelectorAll('form[data-ajax="true"]');
    situacaoForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const id = this.querySelector('input[name="id"]').value;
            const situacao = this.querySelector('input[name="situacao"]').value;
            const button = this.querySelector('button');
            
            fetch('ajax_updates.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=update_situacao&id=${id}&situacao=${situacao}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button text and class
                    button.textContent = situacao;
                    button.className = `badge ${situacao === 'Pendente' ? 'bg-pendente' : 'bg-concluido'}`;
                    // Update hidden input
                    this.querySelector('input[name="situacao"]').value = 
                        situacao === 'Pendente' ? 'Concluído' : 'Pendente';
                } else {
                    alert('Erro ao atualizar situação');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao atualizar situação');
            });
        });
    });

    // Handle local updates
    const localSelects = document.querySelectorAll('select[name="local"][data-ajax="true"]');
    localSelects.forEach(select => {
        select.addEventListener('change', function(e) {
            const form = this.closest('form');
            const id = form.querySelector('input[name="id"]').value;
            
            fetch('ajax_updates.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=update_local&id=${id}&local=${this.value}`
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Erro ao atualizar local');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao atualizar local');
            });
        });
    });
});
</script>

</body>
</html>
