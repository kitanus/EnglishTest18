<form action='/test?page=<?= $data["page"] ?>' method='post'>

    <h2>Слово: <?= $data["Words"][$data["page"]-1]["word"]; ?></h2>

        <?php foreach ($data["order"] as $key => $value): ?>
        <p>
            <div id="test">
                <input class="radio" type="radio" id="check<?= $key; ?>" name="trans" value="<?= $value; ?>">
                <label for="check<?= $key; ?>">
                    <?= $value; ?>
                </label>
            </div>
        </p>
        <?php endforeach; ?>

    <button name='action' class="btn btn-primary" value='check' type="submit">Проверить</button>

</form>