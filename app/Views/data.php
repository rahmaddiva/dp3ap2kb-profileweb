<h2><?= esc($title) ?></h2>

<h3>Layer 2 – Kependudukan</h3>
<table border="1" cellpadding="6">
    <?php foreach ($data['layer2'] as $label => $nilai): ?>
        <tr>
            <td><?= esc($label) ?></td>
            <td><?= esc($nilai) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<h3>Layer 4 – SDGs</h3>
<table border="1" cellpadding="6">
    <?php foreach ($data['layer4'] as $label => $nilai): ?>
        <tr>
            <td><?= esc($label) ?></td>
            <td><?= esc($nilai) ?></td>
        </tr>
    <?php endforeach ?>
</table>