<form action='/setting' method='post'>
    <p>Колличество слов</p>
    <select name="count" class="form-control countPage">
        <?php foreach ($data["count"] as $key => $value): ?>
            <option value="<?= $value["value"] ?>" <?= $value["selected"] ?>><?= $value["content"] ?></option>
        <? endforeach; ?>
    </select>

    <p>Колличество слов, которые вы хотите добавить</p>

    <input type="text" name="countWord">
    <button class="btn btn-primary">Создать</button>

    <?php if(!empty($_POST) && $_POST["countWord"]): ?>
        <div id="windowInsert">
            <?php for($i=0; $i<$_POST["countWord"]; $i++): ?>
                <div class="insertWord">
                    Слово:<input type="text" name="word[]"> Перевод:<input type="text" name="translation[]">
                </div>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <p>Список слов, отметьте ненужные</p>
    <div id="windowUse">
        <?php foreach($data["list"] as $key => $value): ?>
        <div class="WordUse">
            <input type="checkbox" name="notUsed[]" id="checkbox<?= $key ?>" value="<?= $value["word"] ?>" <?= $data["check"][$key] ?>>
            <label for="checkbox<?= $key ?>"><?= $value["word"] ?></label>
        </div>
        <?php endforeach; ?>
    </div>

    <button class="btn btn-primary">Установить</button>
</form>