<?php //$this->isAjax(); ?>

<!-- add cars taxi -->
<?php if($cards) : ?>
    <?php foreach($cards as $car): ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 justify-content-sm-center">
            <div class="card card-driver border-secondary">
                <div class="card-header card-driver-header">
                    <h6 class="title mb-0"><?= ucwords("$car->brand $car->model") ?></h6><i
                        class="fas <?= $car->fa_icon ?> icon align-self-center mr-2"></i>
                </div>
                <img class="card-img-top card-taxi-img align-self-center my-3 rounded" src="img/no-photo.jpg"
                     alt="user">
                <hr class="m-0">
                <div class="card-body card-driver-body py-2">
                    <p class="card-text my-1">Гос. номер: <b><?= $car->gov_num ?></b></p>
                    <?php if(!empty($car->body_type)): ?>
                        <p class="card-text my-1">Тип кузова: <b><?= $car->body_type ?></b></p>
                    <?php endif; ?>
                    <?php if(!empty($car->color)): ?>
                        <p class="card-text my-1">Цвет: <b><?= $car->color ?></b></p>
                    <?php endif; ?>
                    <p class="card-text my-1">Пробег: <b><?= $car->mileage ?> км</b></p>
                    <p class="card-text my-1">Всего рейсов: <b><?= $car->number_flights ?></b></p>
                    <p class="card-text my-1">Год выпуска: <b><?= $car->create_year ?></b></p>
                </div>
                <hr class="m-0">
                <div class="card-body py-2">
                    <h6 class="card-title driver-cars-title cp mb-2">Водители машины <i
                            class="fas fa-chevron-left"></i>
                    </h6>
                    <ul class="list-group list-group-flush driver-cars-list mt-0">
                        <li class="list-group-item"><a class="text-dark cars-list-item" href="/"
                                                       title="Узнать больше">
                                <ul class="p-0">
                                    <li>Фамилия: <b>Поляев</b></li>
                                    <li>Имя: <b>Максим</b></li>
                                    <li>Отчество: <b>Александрович</b></li>
                                    <li>Стаж работы: <b>3 года</b></li>
                                    <li>Дата последнего выезда: <b>02-07-2019</b></li>
                                    <li>Дата рождения: <b>02-02-1999</b></li>
                                    <li>Номер телефона:&nbsp;<a class="text-dark" href="tel:+79209174235"><b>+7
                                                920
                                                917-42-35&nbsp;</b><i class="fas fa-phone"></i></a></li>
                                    <li>Адрес проживания:&nbsp;<b>Владимирская обл., г. Ковров, ул. Маяковского,
                                            д.4&nbsp;</b><i
                                            class="fas fa-address-card"></i></li>
                                </ul>
                            </a></li>
                        <li class="list-group-item"><a class="text-dark cars-list-item" href="/"
                                                       title="Узнать больше">
                                <ul class="p-0">
                                    <li>Фамилия: <b>Поляев</b></li>
                                    <li>Имя: <b>Максим</b></li>
                                    <li>Отчество: <b>Александрович</b></li>
                                    <li>Стаж работы: <b>3 года</b></li>
                                    <li>Дата последнего выезда: <b>02-07-2019</b></li>
                                    <li>Дата рождения: <b>02-02-1999</b></li>
                                    <li>Номер телефона:&nbsp;<a class="text-dark" href="tel:+79209174235"><b>+7
                                                920
                                                917-42-35&nbsp;</b><i class="fas fa-phone"></i></a></li>
                                    <li>Адрес проживания:&nbsp;<b>Владимирская обл., г. Ковров, ул. Маяковского,
                                            д.4&nbsp;</b><i
                                            class="fas fa-address-card"></i></li>
                                </ul>
                            </a></li>
                        <li class="list-group-item"><a class="text-dark cars-list-item" href="/"
                                                       title="Узнать больше">
                                <ul class="p-0">
                                    <li>Фамилия: <b>Поляев</b></li>
                                    <li>Имя: <b>Максим</b></li>
                                    <li>Отчество: <b>Александрович</b></li>
                                    <li>Стаж работы: <b>3 года</b></li>
                                    <li>Дата последнего выезда: <b>02-07-2019</b></li>
                                    <li>Дата рождения: <b>02-02-1999</b></li>
                                    <li>Номер телефона:&nbsp;<a class="text-dark" href="tel:+79209174235"><b>+7
                                                920
                                                917-42-35&nbsp;</b><i class="fas fa-phone"></i></a></li>
                                    <li>Адрес проживания:&nbsp;<b>Владимирская обл., г. Ковров, ул. Маяковского,
                                            д.4&nbsp;</b><i
                                            class="fas fa-address-card"></i></li>
                                </ul>
                            </a></li>
                    </ul>
                </div>
                <div class="card-footer"><a class="card-link text-dark" href="/car-taxi.html"><i
                            class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="col-12">
        <h2>Машины отсутствуют</h2>
    </div>
<?php endif; ?>
<!-- end add cars taxi -->
