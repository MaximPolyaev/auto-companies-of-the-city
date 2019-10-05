<div class="container-fluid mt-2">
    <ul class="nav nav-tabs justify-content-end position-relative" id="truckTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?= isset($modificator) ? ($modificator !== 'trucks' || $modificator === 'drivers' ? 'active' : '') : 'active' ?>" id="driversTruck-tab" data-toggle="tab" href="#driversTruck" role="tab"
               aria-controls="driversTruck" aria-selected="true">Водители грузовиков</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= @$modificator === 'trucks' ? 'active' : '' ?>" id="carsTruck-tab" data-toggle="tab" href="#carsTruck" role="tab" aria-controls="carsTruck"
               aria-selected="false">Грузовики</a>
        </li>
    </ul>
    <div class="tab-content" id="truckTabContent">
        <div class="tab-pane fade <?= isset($modificator) ? ($modificator !== 'trucks' || $modificator === 'drivers' ? 'show active' : '') : 'show active' ?>" id="driversTruck" role="tabpanel" aria-labelledby="driversTruck-tab">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-xl-10 col-lg-9 col-md-8 col-sm-7 pl-0 order-1 order-sm-0 pr-0 pr-sm-2">
                        <form class="form-inline search-form mt-2 mt-sm-0"><i
                                    class="fas fa-search form-control-feedback search-form-icon ml-1" aria-hidden="true"></i>
                            <input class="form-control w-100 pl-4 search-form-input" type="text" placeholder="Поиск..." aria-label="Search"
                                   name="searchGlobal">
                            <button class="btn btn-success search-form-btn" type="submit">Искать</button>
                        </form>
                        <h3 class="mt-2">Водители грузовиков</h3>
                        <hr class="mt-0">
                        <div class="row">
                            <?php if($drivers): ?>
                                <?php foreach($drivers as $driver): ?>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 justify-content-sm-center">
                                        <div class="card card-driver border-secondary">
                                            <div class="card-header card-driver-header">
                                                <h6 class="title mb-0"><?= $driver->surname ?> <?= $driver->name ?> <?= $driver->patronymic ?></h6>
                                                <i
                                                        class="fas fa-user icon align-self-center mr-2"></i>
                                            </div>
                                            <img class="card-img-top card-driver-img align-self-center my-3 rounded-circle"
                                                 src="img/vasya.jpg"
                                                 alt="user">
                                            <hr class="m-0">
                                            <div class="card-body card-driver-body py-2">
                                                <p class="card-text my-1">Таб. номер: <b><?= $driver->id ?></b><i
                                                            class="fas fa-id-card"></i></p>
                                                <p class="card-text my-1">Дата рождения: <b><?= $driver->birthday ?></b></p>
                                                <p class="card-text my-1">Последний выезд: <b>2-05-2019</b></p>
                                                <p class="card-text my-1">Стаж работы:
                                                    <b><?= $driver->date_experience ?> <?= $driver->str_experience ?></b></p>
                                                <p class="card-text my-1">Всего рейсов: <b><?= $driver->number_flights ?></b></p>
                                                <p class="card-text my-1">Номер телефона:&nbsp;
                                                    <?php if($driver->number_phone): ?>
                                                        <a class="text-dark" href="tel:+<?= $driver->number_phone ?>">
                                                            <b><?= $driver->phone_render ?></b><i class="fas fa-phone"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <b class="cp">Отсутствует</b>
                                                    <?php endif; ?>
                                                </p>
                                                <p class="card-text my-1">Адрес проживания:&nbsp;<b><?= $driver->address ?></b><i
                                                            class="fas fa-address-card"></i></p>
                                            </div>
                                            <hr class="m-0">
                                            <div class="card-body py-2">
                                                <h6 class="card-title driver-cars-title cp mb-2">Машины водителя <i
                                                            class="fas fa-chevron-left"></i></h6>
                                                <ul class="list-group list-group-flush driver-cars-list mt-0">
                                                    <li class="list-group-item"><a class="text-dark cars-list-item" href="/car-truck.html"
                                                                                   title="Узнать больше">
                                                            <ul class="p-0">
                                                                <li>Гос. номер: <b>c432ma33</b></li>
                                                                <li>Марка: <b>kia</b></li>
                                                                <li>Модель: <b>bruno</b></li>
                                                                <li>Последний выезд: <b>12-02-2007</b></li>
                                                                <li>Грузоподъемность: <b>25 т</b></li>
                                                            </ul>
                                                        </a></li>
                                                    <li class="list-group-item"><a class="text-dark cars-list-item" href="/car-truck.html"
                                                                                   title="Узнать больше">
                                                            <ul class="p-0">
                                                                <li>Гос. номер: <b>c432ma33</b></li>
                                                                <li>Марка: <b>kia</b></li>
                                                                <li>Модель: <b>bruno</b></li>
                                                                <li>Последний выезд: <b>12-02-2007</b></li>
                                                                <li>Грузоподъемность: <b>25 т</b></li>
                                                            </ul>
                                                        </a></li>
                                                    <li class="list-group-item"><a class="text-dark cars-list-item" href="/car-truck.html"
                                                                                   title="Узнать больше">
                                                            <ul class="p-0">
                                                                <li>Гос. номер: <b>c432ma33</b></li>
                                                                <li>Марка: <b>kia</b></li>
                                                                <li>Модель: <b>bruno</b></li>
                                                                <li>Последний выезд: <b>12-02-2007</b></li>
                                                                <li>Грузоподъемность: <b>25 т</b></li>
                                                            </ul>
                                                        </a></li>
                                                </ul>
                                            </div>
                                            <div class="card-footer"><a class="card-link text-dark" href="/driver-truck.html"><i
                                                            class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <h2>Водители не найдены!</h2>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 pr-0 pl-0 pl-sm-1 order-0 order-sm-1">
                        <a class="btn btn-info w-100 mb-2" href="/" onclick="modalOpen(this); return false;" data-modal="<?= $addModalDriver->id ?>">
                            Добавить водителя
                        </a>
                        <div class="taxi-drivers-param params-panel p-2 border rounded">
                            <h5 class="text-info us-none">Параметры</h5>
                            <form class="params-panel-form">
                                <div class="form-group">
                                    <h6 class="mb-0 cp">Возраст:</h6>
                                    <input class="form-control form-control-sm mt-1" name="age" id="age">
                                    <div class="mx-2 mt-2 cp" id="slider-range-age" data-min="<?= $parametersDrivers->age_interval['min'] ?>" data-max="<?= $parametersDrivers->age_interval['max'] ?>" data-start="<?= $parametersDrivers->age_interval['min'] ?>"
                                         data-end="<?= $parametersDrivers->age_interval['max'] ?>"></div>
                                </div>
                                <div class="form-group form-group_gender">
                                    <h6 class="mb-0 us-none">Пол:</h6>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label mr-1" for="maleCheckbox">Муж:</label>
                                        <input class="form-check-input cp" id="maleCheckbox" type="checkbox" value="male" name="gender">
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label mr-1" for="femaleCheckbox">Жен:</label>
                                        <input class="form-check-input cp" id="femaleCheckbox" type="checkbox" value="female" name="gender">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Кол-во рейсов:</h6>
                                    <input class="form-control form-control-sm mt-1" name="flights" id="flights">
                                    <div class="mx-2 mt-2 cp" id="slider-range-flights" data-min="1" data-max="150" data-start="1"
                                         data-end="150"></div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Дата рейса:</h6>
                                    <div class="input-group input-group-sm mt-1">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text us-none">От:</label>
                                        </div>
                                        <input class="form-control d-inline-block bg-white cp" id="dateFlightFrom" type="text"
                                               autocomplete="off" readonly>
                                    </div>
                                    <div class="input-group input-group-sm mt-1">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text us-none">До:</label>
                                        </div>
                                        <input class="form-control d-inline-block bg-white cp" id="dateFlightTo" type="text"
                                               autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Стаж работы (лет):</h6>
                                    <input class="form-control form-control-sm mt-1" name="experience" id="experience">
                                    <div class="mx-2 mt-2 cp" id="slider-range-experience" data-min="<?= $parametersDrivers->work_experience['min'] ?>" data-max="<?= $parametersDrivers->work_experience['max'] ?>" data-start="<?= $parametersDrivers->work_experience['min'] ?>"
                                         data-end="<?= $parametersDrivers->work_experience['max'] ?>"></div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Грузоподъемность (т.):</h6>
                                    <input class="form-control form-control-sm mt-1 carrying" name="carrying">
                                    <div class="mx-2 mt-2 cp slider-range-carrying" data-min="0" data-max="150" data-start="0"
                                         data-end="150"></div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Выбор машины:</h6>
                                    <div class="form-group-car">
                                        <hr class="my-1">
                                        <select class="custom-select form-group-car_select select-car_mark" name="carMarka1">
                                            <option selected>Не выбрано</option>
                                            <option value="alias1">Рено</option>
                                            <option value="alias2">Лада</option>
                                            <option value="alias3">Аиди</option>
                                        </select>
                                        <hr class="my-1">
                                    </div>
                                    <button class="btn btn-info btn-add-group-car btn-sm" type="button">Добавить</button>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Запрос</h6>
                                    <button class="btn btn-danger">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade <?= @$modificator === 'trucks' ? 'show active' : '' ?>" id="carsTruck" role="tabpanel" aria-labelledby="carsTruck-tab">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-xl-10 col-lg-9 col-md-8 col-sm-7 pl-0 order-1 order-sm-0 pr-0 pr-sm-2">
                        <form class="form-inline search-form mt-2 mt-sm-0"><i
                                    class="fas fa-search form-control-feedback search-form-icon ml-1" aria-hidden="true"></i>
                            <input class="form-control w-100 pl-4 search-form-input" type="text" placeholder="Поиск..." aria-label="Search"
                                   name="searchGlobal">
                            <button class="btn btn-success search-form-btn" type="submit">Искать</button>
                        </form>
                        <h3 class="mt-2">Грузовики</h3>
                        <hr class="mt-0">
                        <div class="row">
                            <?php if($cars): ?>
                                <?php foreach($cars as $car): ?>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 justify-content-sm-center">
                                        <div class="card card-driver border-secondary">
                                            <div class="card-header card-driver-header">
                                                <h6 class="title mb-0"><?= "$car->brand $car->model" ?></h6><i
                                                        class="fas <?= $car->fa_icon ?> icon align-self-center mr-2"></i>
                                            </div>
                                            <img class="card-img-top card-taxi-img align-self-center my-3 rounded"
                                                 src="img/<?= $car->photo ?>"
                                                 alt="Фото">
                                            <hr class="m-0">
                                            <div class="card-body card-driver-body py-2">
                                                <p class="card-text my-1">Гос. номер: <b><?= $car->gov_num ?></b></p>
                                                <p class="card-text my-1">Грузоподъемность: <b><?= $car->carrying ?> т</b></p>
                                                <p class="card-text my-1">Пробег: <b><?= $car->mileage ?> км</b></p>
                                                <p class="card-text my-1">Всего рейсов: <b><?= $car->number_flights ?></b></p>
                                                <?php if(!empty($car->color)): ?>
                                                    <p class="card-text my-1">Цвет: <b><?= $car->color ?></b></p>
                                                <?php endif; ?>
                                                <p class="card-text my-1">Год выпуска: <b><?= $car->create_year ?></b></p>
                                            </div>
                                            <hr class="m-0">
                                            <div class="card-body py-2">
                                                <h6 class="card-title driver-cars-title cp mb-2">
                                                    Водители машины <i class="fas fa-chevron-left"></i>
                                                </h6>
                                                <ul class="list-group list-group-flush driver-cars-list mt-0">
                                                    <li class="list-group-item">
                                                        <a class="text-dark cars-list-item" href="/driver-truck.html" title="Узнать больше">
                                                            <ul class="p-0">
                                                                <li>Фамилия: <b>Поляев</b></li>
                                                                <li>Имя: <b>Максим</b></li>
                                                                <li>Отчество: <b>Александрович</b></li>
                                                                <li>Стаж работы: <b>3 года</b></li>
                                                                <li>Дата последнего выезда: <b>02-07-2019</b></li>
                                                                <li>Дата рождения: <b>02-02-1999</b></li>
                                                                <li>Номер телефона:&nbsp;<a class="text-dark" href="tel:+79209174235"><b>+7 920 917-42-35&nbsp;</b>
                                                                        <i class="fas fa-phone"></i></a></li>
                                                                <li>
                                                                    Адрес проживания:&nbsp;<b>Владимирская обл., г. Ковров, ул. Маяковского, д.4&nbsp;</b><i class="fas fa-address-card"></i>
                                                                </li>
                                                            </ul>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item"><a class="text-dark cars-list-item"
                                                                                   href="/driver-truck.html"
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
                                                    <li class="list-group-item"><a class="text-dark cars-list-item"
                                                                                   href="/driver-truck.html"
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
                                            <div class="card-footer"><a class="card-link text-dark" href="/car-truck.html"><i
                                                            class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <h2>Грузовики отсутствуют</h2>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 pr-0 pl-0 pl-sm-1 order-0 order-sm-1"><a class="btn btn-info w-100 mb-2"
                                                                                                             href="/"
                                                                                                             onclick="modalOpen(this); return false;"
                                                                                                             data-modal="<?= $addModalCar->id ?>">Добавить
                            машину</a>
                        <div class="params-panel p-2 border rounded">
                            <h5 class="text-info us-none">Параметры</h5>
                            <form class="params-panel-form">
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Выбор машины:</h6>
                                    <div class="form-group-car">
                                        <hr class="my-1">
                                        <select class="custom-select form-group-car_select select-car_mark" name="mark">
                                            <option selected value="no">Не выбрано</option>
                                            <option value="alias1">sdfdsf</option>
                                            <option value="alias1">sdfdsf</option>
                                            <option value="alias1">sdfdsf</option>
                                            <option value="alias1">sdfdsf</option>
                                            <option value="alias1">sdfdsf</option>
                                            <option value="alias1">sdfdsf</option>
                                            <option value="alias1">sdfdsf</option>
                                            <option value="alias1">sdfdsf</option>
                                        </select>
                                        <hr class="my-1">
                                    </div>
                                    <button class="btn btn-info btn-add-group-car btn-sm" type="button">Добавить</button>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-1 us-none">Цвет машины:</h6>
                                    <select class="custom-select" name="color">
                                        <option selected>Не выбрано</option>
                                        <?php foreach($parametersCars->colors as $color): ?>
                                            <option value="<?= $color ?>"><?= mb_ucfirst($color) ?></option>
                                        <?php endforeach; ?>
                                        <option value="absent">Отсутствует</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 cp">Пробег (км):</h6>
                                    <input class="form-control form-control-sm mt-1" name="mileage" id="mileage">
                                    <div class="mx-2 mt-2 cp" id="slider-range-mileage" data-min="<?= $parametersCars->mileage['min'] ?>"
                                         data-max="<?= $parametersCars->mileage['max'] ?>"
                                         data-start="<?= $parametersCars->mileage['min'] ?>"
                                         data-end="<?= $parametersCars->mileage['max'] ?>"></div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Кол-во рейсов:</h6>
                                    <input class="form-control form-control-sm mt-1" name="carFlights" id="carFlights">
                                    <div class="mx-2 mt-2 cp" id="slider-range-carFlights" data-min="1" data-max="150" data-start="1"
                                         data-end="150"></div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Грузоподъемность (т.):</h6>
                                    <input class="form-control form-control-sm mt-1 carrying" name="carrying">
                                    <div class="mx-2 mt-2 cp slider-range-carrying" data-min="0" data-max="150" data-start="0"
                                         data-end="150"></div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Дата рейса:</h6>
                                    <div class="input-group input-group-sm mt-1">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text us-none">От:</label>
                                        </div>
                                        <input class="form-control d-inline-block bg-white cp" id="dateCarFlightFrom" type="text"
                                               autocomplete="off" readonly>
                                    </div>
                                    <div class="input-group input-group-sm mt-1">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text us-none">До:</label>
                                        </div>
                                        <input class="form-control d-inline-block bg-white cp" id="dateCarFlightTo" type="text"
                                               autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Год выпуска:</h6>
                                    <input class="form-control form-control-sm mt-1" name="year" id="yearCar">
                                    <div class="mx-2 mt-2 cp" id="slider-range-yearCar" data-min="<?= $parametersCars->year['min'] ?>"
                                         data-max="<?= $parametersCars->year['max'] ?>"
                                         data-start="<?= $parametersCars->year['min'] ?>"
                                         data-end="<?= $parametersCars->year['max'] ?>"></div>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-0 us-none">Запрос</h6>
                                    <button class="btn btn-danger">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>