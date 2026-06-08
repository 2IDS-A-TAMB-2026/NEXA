<h1>OCORRENCIA EPI</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>OCORRENCIA</th>
    <th>EPI</th>
</tr>

<?php foreach($ocorrenciaEpi as $o): ?>

<tr>
    <td><?= $o['ID'] ?></td>
    <td><?= $o['FK_OCORRENCIA_ID'] ?></td>
    <td><?= $o['FK_EPI_ID'] ?></td>
</tr>

<?php endforeach; ?>

</table>