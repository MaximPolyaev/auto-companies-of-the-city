<?php

function debug($arr) {
    echo '<pre style="background-color: #E9E7E9; width: 100%; color: black; font-size: 16px; padding: 10px; border-top: 2px solid #5181B8;' .
        ' border-bottom: 2px solid #5181B8">';
    print_r($arr);
    echo '</pre>';
}

function rus_translate($str) {
    $converter = [
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

        'А' => 'A', 'Б' => 'B', 'В' => 'V',
        'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'Y', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
        'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
    ];

    return strtr($str, $converter);
}

function mb_ucfirst($str) {
    $str = mb_strtolower($str, 'UTF-8');

    $str = mb_strtoupper(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($str, 1, null,'UTF-8');

    return $str;
}

function redirect($http = false) {
    if($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}

function messageBox($string, $format = 'danger') {
    return '<div class="alert alert-' . $format . ' alert-dismissible fade show" role="alert">
                    <strong>Внимение!</strong> ' . $string . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
}

function debugDBTable($arr) {
    if(empty($arr)) {
        echo "Пустой массив";
        return;
    }
    $headers = '<th scope="col">#</th>';
    foreach($arr[0] as $key => $value) {
        $headers .= '<th scope="col">' . $key . '</th>';
    }

    $tr_items = [];
    for($i = 0; $i < count($arr); $i++) {
        $tr_items[$i] = "<th scope=\"row\">${i}</th>";
        foreach($arr[$i] as $key => $value) {
            $tr_items[$i] .= "<td>${value}</td>";
        }
    }

    $tr_str = '';
    foreach($tr_items as $item) {
        $tr_str .= "<tr>";
        $tr_str .= $item;
        $tr_str .= "</tr>";
    }

    $htmlTable = "<table class=\"table table-striped\">
            <thead>
                <tr>
                  ${headers}
                </tr>
            </thead>
            <tbody>
                ${tr_str}
            </tbody>
        </table>";

    echo $htmlTable;
}