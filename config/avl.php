<?php

return [

    'permissions' => [
        'read' => 'Чтение',
        'add' => 'Добавление',
        'edit' => 'Редактирование',
        'delete' => 'Удаление'
    ],

    'good' => [
        0 => 'Нет',
        1 => 'Да'
    ],

    'goodBange' => [
        0 => '<span class="badge badge-danger">Нет</span>',
        1 => '<span class="badge badge-success">Да</span>'
    ],

    'sections' => [
        'page' => 'Страница',
        'news' => 'Новости',
        'link' => 'Ссылка',
        'links' => 'Каталог ссылок',
    ],

    'sorts' => [
        1 => 'По дате по возрастанию',
        2 => 'По дате по убыванию',
        3 => 'По алфавиту заголовка по возрастанию',
        4 => 'По алфивиту заголовка по убыванию',
        5 => 'По id по возрастанию',
        6 => 'По id по убыванию',
    ],

    /* Статусы для обращений ключи не изменять*/
    'statuses' => [
        0 => 'В обработке',
        1 => 'Рассмотрено',
        2 => 'Отклонено',
        // 2 => 'Отвечено',
    ],
    'statusesBadge' => [
        0 => '<span class="badge badge-warning">В обработке</span>',
        1 => '<span class="badge badge-success">Рассмотрено</span>',
        2 => '<span class="badge badge-danger">Отклонено</span>',
        // 2 => 'Отвечено',
    ],

    'picMaxSize' => '3145728',

    'months' => [
        'ru' => [
            '1' => 'Январь',
            '2' => 'Февраль',
            '3' => 'Март',
            '4' => 'Апрель',
            '5' => 'Май',
            '6' => 'Июнь',
            '7' => 'Июль',
            '8' => 'Август',
            '9' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь',
        ],
        'en' => [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ],
        'kz' => [
            '1' => "Қаңтар",
            '2' => "Ақпан",
            '3' => "Наурыз",
            '4' => "Сәуір",
            '5' => "Мамыр",
            '6' => "Маусым",
            '7' => "Шілде",
            '8' => "Тамыз",
            '9' => "Қыркүйек",
            '10' => "Қазан",
            '11' => "Қараша",
            '12' => "Желтоқсан",
        ],
    ],

    'inmonths' => [

        'ru' => [
            'Jan' => 'января',
            'Feb' => 'февраля',
            'Mar' => 'марта',
            'Apr' => 'апреля',
            'May' => 'мая',
            'Jun' => 'июня',
            'Jul' => 'июля',
            'Aug' => 'августа',
            'Sep' => 'сентября',
            'Oct' => 'октября',
            'Nov' => 'ноября',
            'Dec' => 'декабря',
        ],
        'en' => [
            'Jan' => 'January',
            'Feb' => 'February',
            'Mar' => 'March',
            'Apr' => 'April',
            'May' => 'May',
            'Jun' => 'June',
            'Jul' => 'July',
            'Aug' => 'August',
            'Sep' => 'September',
            'Oct' => 'October',
            'Nov' => 'November',
            'Dec' => 'December',
        ],
        'kz' => [
            'Jan' => 'қаңтар',
            'Feb' => 'ақпан',
            'Mar' => 'наурыз',
            'Apr' => 'сәуір',
            'May' => 'мамыр',
            'Jun' => 'маусым',
            'Jul' => 'шілде',
            'Aug' => 'тамыз',
            'Sep' => 'қыркүйек',
            'Oct' => 'қазан',
            'Nov' => 'қараша',
            'Dec' => 'желтоқсан',
        ]

    ]
];