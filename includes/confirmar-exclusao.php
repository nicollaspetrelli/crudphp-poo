<main>
    <h2 class="mt-3">Excluir vaga</h2>

    <form method="post">
        <div class="form-group mb-2">
            <p>Você deseja realmente excluir a vaga <strong class="text-"><?=$vaga->titulo?></strong>?</p>
        </div>

        <div class="form-group mt-2">
            <a href="/" class="btn btn-secondary">Cancelar</a>
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </div>

    </form>

</main>