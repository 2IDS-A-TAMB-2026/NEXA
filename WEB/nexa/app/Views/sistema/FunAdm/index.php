<h1>FUN ADM</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>FUNCIONARIO</th>
    <th>ADMIN</th>
</tr>

<?php foreach($funAdm as $f): ?>

<tr>
    <td><?= $f['ID'] ?></td>
    <td><?= $f['FK_FUNCIONARIO_CPF'] ?></td>
    <td><?= $f['FK_ADMINISTRADOR_CPF'] ?></td>
</tr>

<?php endforeach; ?>

</table>