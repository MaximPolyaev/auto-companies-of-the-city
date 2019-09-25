<div class="container-fluid mt-0 mt-sm-2">
    <div class="row justify-content-center">
        <div class="col-sm-10 bg-white border rounded py-3">
            <h3>Автобусный маршрут</h3>
            <?php if($routeData): ?>
                <ul>
                    <li>Название маршрута: <b><?= $routeData->name ?></b></li>
                    <li>Конечные остановки: <b><?= $routeData->short_desc ?? 'Информация отсутствует' ?></b></li>
                    <li>Маршрут следования: <?= $routeData->desc ?? 'Информация отсутствует' ?></li>
                </ul><a class="btn btn-danger" href="/">Удалить маршрут</a>
            <?php else: ?>
                <h4>Информация о маршруте отсутствует!</h4>
            <?php endif; ?>
        </div>
    </div>
</div>