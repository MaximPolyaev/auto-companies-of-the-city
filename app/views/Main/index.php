<div class="container-fluid mt-2">
    <div class="row pt-2 justify-content-md-start justify-content-sm-center">
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-9 my-1">
            <div class="card bg-warning text-dark">
                <h3 class="card-header">Отдел такси <i class="fas fa-taxi"></i></h3>
                <div class="card-body">
                    <p class="card-text">Всего рабочих: <b><?= $numberDrivers->driver_taxi ?></b> <i class="fas fa-user"></i></p>
                    <p class="card-text">Всего машин: <b>23</b> <i class="fas fa-car"></i></p>
                </div>
                <div class="card-footer"><a class="card-link text-dark" href="department/taxi"><i class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-9 my-1">
            <div class="card bg-dark text-white">
                <h3 class="card-header">Отдел грузового ТС <i class="fas fa-truck"></i></h3>
                <div class="card-body">
                    <p class="card-text">Всего рабочих: <b><?= $numberDrivers->driver_truck ?></b> <i class="fas fa-user"></i></p>
                    <p class="card-text">Всего машин: <b>21</b> <i class="fas fa-car"></i></p>
                </div>
                <div class="card-footer"><a class="card-link text-white" href="department/truck"><i class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-9 my-1">
            <div class="card bg-primary text-white">
                <h3 class="card-header">Автобусный отдел <i class="fas fa-bus"></i></h3>
                <div class="card-body">
                    <p class="card-text">Всего рабочих: <b><?= $numberDrivers->driver_bus ?></b> <i class="fas fa-user"></i></p>
                    <p class="card-text">Всего машин: <b>54</b> <i class="fas fa-car"></i></p>
                </div>
                <div class="card-footer"><a class="card-link text-white" href="department/bus"><i class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-9 my-1">
            <div class="card bg-danger text-white">
                <h3 class="card-header">Отдел ремонта <i class="fas fa-wrench"></i></h3>
                <div class="card-body">
                    <p class="card-text">Всего работников: <b>323</b> <i class="fas fa-user"></i></p>
                    <p class="card-text">Машин в ремонте: <b>10</b> <i class="fas fa-car"></i></p>
                    <p class="card-text">Машин списоно за последний месяц: <b>8</b> <i class="fas fa-car"></i></p>
                    <p class="card-text">Всего машин списано: <b>9</b> <i class="fas fa-car"></i></p>
                </div>
                <div class="card-footer"><a class="card-link text-white" href="/repair.html"><i class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-9 my-1">
            <div class="card bg-secondary text-white">
                <h3 class="card-header">Отдел кадров <i class="fas fa-users"></i></h3>
                <div class="card-body">
                    <p class="card-text">Всего задействовано в сфере: <b><?= $numberDrivers->all_drivers ?></b> <i class="fas fa-user"></i></p>
                    <p class="card-text">Сотрудников принято на работу за месяц: <b>10</b> <i class="fas fa-user"></i></p>
                    <p class="card-text">Сотрудников уволено за за месяц: <b>15</b> <i class="fas fa-user"></i></p>
                    <p class="card-text">Всего уволено сотрудников: <b>25</b> <i class="fas fa-user"></i></p>
                </div>
                <div class="card-footer"><a class="card-link text-white" href="/personnel.html"><i class="fas fa-arrow-circle-right"></i> Подробнее</a></div>
            </div>
        </div>
    </div>
</div>