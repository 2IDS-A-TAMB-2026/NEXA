<h1>EPI ADM</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>EPI</th>
    <th>ADMIN</th>
</tr>

<?php foreach($epiAdm as $e): ?>

<tr>
    <td><?= $e['ID'] ?></td>
    <td><?= $e['FK_EPI_ADM'] ?></td>
    <td><?= $e['FK_ADMINISTRADOR_CPF'] ?></td>
</tr>

<?php endforeach; ?>

</table>