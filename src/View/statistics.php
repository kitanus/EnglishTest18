<?php if($data["test"] == "end"): ?>
    <div class="hero-unit">
            <h2>Вы прошли тест. Если хотите начать заново, перейдите на стартовую страницу.</h2>
    </div>
<?php endif; ?>

<table class="table table-striped table-condensed">
    <caption class="caption"><h3>Статистика</h3></caption>
    <tr>
        <th>Слово</th>
        <th>Перевод</th>
        <th>Угадано</th>
        <th>Не угадано</th>
        <th>Состояние</th>
    </tr>
    <?php foreach($data["wordList"] as $key => $value): ?>
        <tr>
            <td><?= $value["word"]; ?></td>
            <td><?= $value["translation"]; ?></td>
            <td><?= $value["good_count"]; ?></td>
            <td><?= $value["all_time"]-$value["good_count"]; ?></td>
            <td style="background-color: <?= $data["colors"][$key]?>;"><?= $value["value"]; ?></td>
        </tr>
    <?php endforeach; ?>
</table>