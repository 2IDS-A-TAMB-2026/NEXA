<h1>EMPRESA ADM</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>EMPRESA</th>
    <th>ADMIN</th>
</tr>

<?php foreach($empresaAdm as $e): ?>

<tr>
    <td><?= $e['ID'] ?></td>
    <td><?= $e['FK_EMPRESA_CNPJ'] ?></td>
    <td><?= $e['FK_ADMINISTRADOR_CPF'] ?></td>
</tr>

<?php endforeach; ?>

</table>