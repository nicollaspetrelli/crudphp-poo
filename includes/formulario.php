<main>
    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">
        <div class="form-group mb-2">
            <label for="titulo">Titulo</label>
            <input type="text" class="form-control" name="titulo" id="titulo" required autofocus value="<?= $vaga->titulo ?>">
        </div>
        <div class="form-group mb-2">
            <label for="descricao">Descricao</label>
            <textarea name="descricao" id="descricao" class="form-control"><?= $vaga->descricao ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label>Status</label>
            <div>
                <div class="form-check form-check-inline p-0 m-0">
                    <label class="form-control">
                        <input type="radio" name="ativo" id="ativo" value="s" checked> Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline p-0 m-0">
                    <label class="form-control">
                        <input type="radio" name="ativo" id="ativo" value="n" <?= $vaga->ativo == 'n' ? 'checked' : '' ?>> inativo
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group mt-5">
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="/" class="btn btn-secondary">Voltar</a>
        </div>

    </form>

</main>