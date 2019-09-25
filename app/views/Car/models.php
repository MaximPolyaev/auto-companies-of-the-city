<?php if(!empty($models)): ?>
    <?php foreach($models as $model): ?>
        <option value="<?= $model['name_alias'] ?>"><?= $model['name'] ?></option>
    <?php endforeach; ?>
<?php endif; ?>