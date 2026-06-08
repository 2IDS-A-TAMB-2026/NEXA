<h1>EMPRESAS</h1>

<a href="<?= base_url('empresa/novo') ?>">Novo</a>

<table border="1">
    <tr>
        <th>CNPJ</th>
        <th>NOME</th>
        <th>AÇÕES</th>
    </tr>

    <?php foreach($empresas as $e): ?>

    <tr>
        <td><?= $e['CNPJ'] ?></td>
        <td><?= $e['NOME'] ?></td>

        <td>
            <a href="<?= base_url('empresa/editar/'.$e['CNPJ']) ?>">Editar</a>

            <a href="<?= base_url('empresa/excluir/'.$e['CNPJ']) ?>">Excluir</a>
        </td>
    </tr>

    <?php endforeach; ?>
</table>