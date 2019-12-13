<?php if(isset($id) && !empty($id)): ?>
<div class="modal fade in" id="<?= $id ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $title ?> <i class="fas fa-user"></i></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php foreach($errors as $error): ?>
                    <?= messageBox($error) ?>
                <?php endforeach; ?>
                <form id="<?= $id ?>_form" action="add-driver/<?= $status ?>" method="GET">
                    <div class="form-group form-input-car">
                        <div class="input-group form-input-car_mark">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Фамилия:</div>
                            </div>
                            <input class="form-control" type="text" name="surname">
                        </div>
                    </div>
                    <div class="form-group form-input-car">
                        <div class="input-group form-input-car_mark">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Имя:</div>
                            </div>
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="form-group form-input-car">
                        <div class="input-group form-input-car_mark">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Отчество:</div>
                            </div>
                            <input class="form-control" type="text" name="patronymic">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Дата рождения:</div>
                            </div>
                            <input class="form-control d-inline-block bg-white cp" id="dateAgeUser" type="text" autocomplete="off" readonly name="birthday">
                        </div>
                    </div>
                    <div class="form-group form-group_gender">
                        <div class="input-group input-group__border rounded">
                            <div class="input-group-prepend mr-3">
                                <div class="input-group-text border-top-0 border-bottom-0 border-left-0">Пол:</div>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label mr-1" for="maleInput">Муж:</label>
                                <input class="form-check-input cp" id="maleInput" type="checkbox" value="male" name="gender">
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label mr-1" for="femaleInput">Жен:</label>
                                <input class="form-check-input cp" id="femaleInput" type="checkbox" value="female" name="gender">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-input-car">
                        <div class="input-group form-input-car_mark">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Стаж работы (в годах):</div>
                            </div>
                            <input class="form-control" type="text" name="experience">
                        </div>
                    </div>
                    <div class="form-group form-input-car">
                        <div class="input-group form-input-car_mark">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Номер телефона (+7 ... ):</div>
                            </div>
                            <input class="form-control input-phone" type="text" name="phone" placeholder="+7 (xxx) xxx-xx-xx">
                        </div>
                    </div>
                    <div class="form-group form-input-car">
                        <div class="input-group form-input-car_mark">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Адрес:</div>
                            </div>
                            <input class="form-control" type="text" name="address">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="<?= $id ?>_form" class="btn btn-info">Добавить</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>