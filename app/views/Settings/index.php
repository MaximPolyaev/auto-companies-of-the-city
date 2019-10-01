<div class="container-fluid mt-2">
    <div class="row justify-content-md-start justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-9">
            <form class="bg-white border rounded p-3 form-add-photo">
                <h5>Фото для работника</h5>
                <div class="input-group mb-2">
                    <div class="input-group-prepend"><span class="input-group-text">Таб.номер</span></div>
                    <input class="form-control form-add-photo_number" type="text">
                </div>
                <h6 class="form-add-photo_user border rounded p-2">Поляев Максим Александрович</h6>
                <div class="input-group mb-2">
                    <div class="custom-file">
                        <input class="custom-file-input" id="user_photo_input" type="file" accept=".img, .jpg">
                        <label class="custom-file-label" for="user_photo_input">Выберите файл</label>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Отправить</button>
            </form>
        </div>
        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-3">
            <h6>Debug:</h6>
            <?php

                //debug(\enterprices\Converter::toPhone('+7 (920) 917-42-35'));

            ?>
        </div>
    </div>
</div>