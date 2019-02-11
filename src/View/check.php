<?php if($data["page"] == count($data["Words"])): ?>
    <form action='/statistics?test=end' method='post'>
<?php else: ?>
    <form action='/test?page=<?= $data["page"]+1 ?>' method='post'>
<?php endif; ?>



    <h2>Слово: <?= $data["Words"][$data["page"]-1]["word"]; ?></h2>

    <?php foreach ($data["finalOrder"] as $key => $value): ?>
        <div class="checkWords <?= $value[0]; ?>">
            <?= $value[1]; ?>
        </div>
    <?php endforeach ?>

    <div id="notice<?= $data["answer"][0]; ?>">
        <?= $data["answer"][1]; ?>
    </div>

    <button class="btn btn-primary" type="submit">Дальше</button>

</form>