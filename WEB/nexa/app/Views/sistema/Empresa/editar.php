<h1>EDITAR EMPRESA</h1>

<form method="post" action="<?= base_url('empresa/atualizar/'.$empresa['CNPJ']) ?>">

    <input type="text" name="CNPJ" value="<?= $empresa['CNPJ'] ?>"><br><br>

    <input type="text" name="NOME" value="<?= $empresa['NOME'] ?>"><br><br>

    <input type="text" name="RUA" value="<?= $empresa['RUA'] ?>"><br><br>

    <input type="text" name="CEP" value="<?= $empresa['CEP'] ?>"><br><br>

    <input type="text" name="NUMERO" value="<?= $empresa['NUMERO'] ?>"><br><br>

    <button type="submit">Atualizar</button>

</form>