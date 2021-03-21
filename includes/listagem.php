<?php 
    $mensagem = '';    

    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;

            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;
            
            default:
                $mensagem = '';
                break;
        }
    }

    $resultados = '';

    foreach($vagas as $vaga){

        // Tratando dados
        $ativo = $vaga->ativo == 's' ? 'Ativo' : 'Inativo';
        $data = date('d/m/Y à\s H:i:s', strtotime($vaga->data));

        $resultados .= "<tr>
                            <td> $vaga->id </td>
                            <td> $vaga->titulo </td>
                            <td> $vaga->descricao </td>
                            <td> $ativo </td>
                            <td> $data </td>
                            <td>
                                <a href=\"editar.php?id=$vaga->id\" class=\"btn btn-sm btn-primary\">Editar</a>
                                <a href=\"excluir.php?id=$vaga->id\" class=\"btn btn-sm btn-danger\">Excluir</a>
                            </td>
                        </tr>";
    }

    $resultados = strlen($resultados) ? $resultados : '<tr><td colspan="6" class="text-center">Nenhuma vaga encontrada!</td></tr>';
?>

<main>

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php" class="btn btn-success">Nova Vaga</a>
    </section>

    <section>
        <form method="get">
            <div class="row my-4">
                <div class="col">
                    <label for="">Buscar por título</label>
                    <input type="text" name="busca" class="form-control">
                </div>
                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </section>

    <section>
        <table class="table bg-light mt-3 table-striped">
            <thead>
                <th>ID</th>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Data</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>
    </section>
</main>