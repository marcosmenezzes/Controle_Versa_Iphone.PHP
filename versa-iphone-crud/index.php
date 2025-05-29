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
    <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
        <a href="adicionar.php" class="btn btn-success flex-grow-1 flex-sm-grow-0">➕ Adicionar Aparelho</a>
    </div>

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
            $sql = "SELECT * FROM aparelhos ORDER BY id DESC";
            $resultado = mysqli_query($conexao, $sql);

            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['id_aparelho']}</td>";
                echo "<td>{$row['modelo']}</td>";
                echo "<td>{$row['descricao']}</td>";

                echo "<td>
                    <form method='POST' action='update_local.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <select name='local' class='form-select form-select-sm' onchange='this.form.submit()' aria-label='Local do aparelho'>
                            <option ".($row['local'] == 'Versa' ? 'selected' : '').">Versa</option>
                            <option ".($row['local'] == 'Alex' ? 'selected' : '').">Alex</option>
                            <option ".($row['local'] == 'Bin' ? 'selected' : '').">Bin</option>
                        </select>
                    </form>
                </td>";

                $badgeClass = ($row['situacao'] == 'Pendente') ? 'bg-pendente' : 'bg-concluido';

                echo "<td>
                    <form method='POST' action='update_situacao.php'>
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
        mysqli_data_seek($resultado, 0); // Resetar resultado para reutilizar
        while ($row = mysqli_fetch_assoc($resultado)) {
            $badgeClass = ($row['situacao'] == 'Pendente') ? 'bg-pendente' : 'bg-concluido';
            echo "<div class='card-item'>";
            echo "<div><label>ID:</label> {$row['id']}</div>";
            echo "<div><label>ID Aparelho:</label> {$row['id_aparelho']}</div>";
            echo "<div><label>Modelo:</label> {$row['modelo']}</div>";
            echo "<div><label>Descrição:</label> {$row['descricao']}</div>";

            echo "<div><label>Local:</label>
                <form method='POST' action='update_local.php' class='d-inline'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <select name='local' class='form-select form-select-sm d-inline w-auto' onchange='this.form.submit()' aria-label='Local do aparelho'>
                        <option ".($row['local'] == 'Versa' ? 'selected' : '').">Versa</option>
                        <option ".($row['local'] == 'Alex' ? 'selected' : '').">Alex</option>
                        <option ".($row['local'] == 'Bin' ? 'selected' : '').">Bin</option>
                    </select>
                </form>
            </div>";

            echo "<div><label>Situação:</label>
                <form method='POST' action='update_situacao.php' class='d-inline'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='situacao' value='".($row['situacao'] == 'Pendente' ? 'Concluído' : 'Pendente')."'>
                    <button type='submit' class='badge {$badgeClass}' aria-label='Alterar situação'>
                        {$row['situacao']}
                    </button>
                </form>
            </div>";

            echo "<div><label>Data:</label> {$row['data_cadastro']}</div>";

            echo "<div class='mt-2'>
                <a href='editar.php?id={$row['id']}' class='btn btn-primary btn-sm me-1'>Editar</a>
                <a href='deletar.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a>
            </div>";

            echo "</div>";
        }
        ?>
    </div>
</div>

</body>
</html>
