<?php if(isset($id) && !empty($id)): ?>
    <div class="modal fade in" id="<?= $id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $title ?> <i class="fas <?= $faIcon ?>"></i></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php foreach($errors as $error): ?>
                        <?= messageBox($error) ?>
                    <?php endforeach; ?>
                    <form id="<?= $id ?>_form" action="add-car/<?= $status ?>" method="GET" data-status="<?= $status ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Гос. номер:</div>
                                </div>
                                <input class="form-control" type="text" placeholder="A777AA77" name="govnum">
                            </div>
                        </div>
                        <div class="form-group form-input-car">
                            <div class="input-group form-input-car_mark">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Марка:</div>
                                </div>
                                <select class="custom-select form-control" name="mark">
                                    <option selected value="no">Не выбрано</option>
                                    <?php foreach($carMarks as $mark): ?>
                                        <option value="<?= $mark->name_alias ?>"><?= $mark->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php if($status === 'taxi'): ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Тип кузова машины:</div>
                                    </div>
                                    <select class="custom-select form-control" name="bodytype">
                                        <option selected value="no">Не выбрано</option>
                                        <?php foreach($bodyTypesCars as $bodyType): ?>
                                            <option value="<?= $bodyType->name_alias ?>"><?= mb_ucfirst($bodyType->name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Цвет машины:</div>
                                </div>
                                <input type="text" class="form-control" name="color">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Год выпуска:</div>
                                </div>
                                <select class="custom-select form-control select-year-car" name="year">
                                    <option selected value="no">Не выбрано</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Пробег (км):</div>
                                </div>
                                <input class="form-control" type="text" name="mileage">
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