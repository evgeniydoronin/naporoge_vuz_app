<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <!-- Page Title  -->
    <title>Na poroge - Admin panel</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <!-- Premade Skin style -->
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-naporoge.css') }}">
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
<div class="nk-app-root">

    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
            <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-sidebar-brand">
                    <a href="/" class="logo-link nk-sidebar-logo">
                        <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}">
                        <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.png') }}">
                        <img class="logo-small logo-img logo-img-small" src="{{ asset('images/logo-small.png') }}" >
                    </a>
                </div>
                <div class="nk-menu-trigger me-n2">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
            </div><!-- .nk-sidebar-element -->
            <div class="nk-sidebar-element">
                <div class="nk-sidebar-content">
                    <div class="nk-sidebar-menu" data-simplebar>
                        <!-- navigation @s -->
                        @include('layouts.app.navigation')
                        <!-- navigation @e -->
                    </div><!-- .nk-sidebar-menu -->
                </div><!-- .nk-sidebar-content -->
            </div><!-- .nk-sidebar-element -->
        </div>
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ms-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand d-xl-none">
                            <a href="html22/index.html" class="logo-link">
                                <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}">
                            </a>
                        </div><!-- .nk-header-brand -->

                        <!-- status message @s -->
                        @if(session()->has('status'))

                        <div class="nk-header-search admin-alert-status ms-3 ms-xl-0">
                            <p class="fw-medium text-success"><em class="icon ni ni-alert-circle"></em> {{ session()->get('status') }}</p>
                        </div>
                        <script>
                            const alertWrapStatus = document.querySelector('.admin-alert-status')
                            setTimeout(() => {
                                alertWrapStatus.remove();
                            }, 2000)
                        </script>

                        @endif
                        <!-- status message @e -->

                        <div class="nk-header-tools">
                            @include('layouts.app.topbar')
                        </div>
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->

            <!-- content @s -->
            {{ $slot }}
            <!-- content @e -->

            <!-- footer @s -->
            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->

</div>
<!-- app-root @e -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Дата старта <span class="text-primary">12-03-2022</span> | Время первого дня <span class="text-primary">12:35</span> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Выполнено</th>
                        <th scope="col">Отлично</th>
                        <th scope="col">Хорошо</th>
                        <th scope="col">Слабо</th>
                        <th scope="col">Общее</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Изучение психологии общения с детьми.</td>
                        <td>16 из 18</td>
                        <td>10</td>
                        <td>4</td>
                        <td>2</td>
                        <td>отлично</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal UPDATE STUDENTS -->
<div class="modal fade" id="updateStudentsModal" tabindex="-1" aria-labelledby="updateStudentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStudentsModalLabel">Обновление студентов</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="#" class="form-validate">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="default-06">Расшифровка что делать</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" id="default-06">
                                            <option value="default_option">Выбрать вуз</option>
                                            <option value="option_select_name">Вуз №1</option>
                                            <option value="option_select_name">Вуз №2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="default-06">Расшифровка что делать</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" id="default-06">
                                            <option value="default_option">Выбрать группу</option>
                                            <option value="option_select_name">Группа №1</option>
                                            <option value="option_select_name">Группа №2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="upload-zone">
                                <div class="dz-message" data-dz-message>
                                    <span class="dz-message-text">Загружается эксель файл, где столбики: Код активации, ФИО студента (текст), оценка аттестации (пусто или число: 0-«Потенциал роста», 1-«Хорошо», 2-«Отлично»).</span>
                                    <br>
                                    <span class="dz-message-text">Перетащить сюда EXCEL файл</span>
                                    <span class="dz-message-or">или</span>
                                    <button class="btn btn-outline-primary">найти на компьютере</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="button" class="btn btn-primary mt-4">Обновить</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal UPDATE TEXT SLIDE -->
<div class="modal fade" id="updateTextSlideModal" tabindex="-1" aria-labelledby="updateTextSlideModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTextSlideLabel">Обновление слайда</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="#" class="form-validate">
                    <div class="row g-gs">

                        <div class="col-md-12">
                            <div class="form-control-wrap">
                <textarea class="tinymce-toolbar-text form-control">
                  <p>«Я» - <strong>знакомый</strong> <i>каждому</i> человеку факт наличия – существования его самого.</p>
                  <p>«Это – Я», - произносил множество раз любой из нас.</p>
                </textarea>
                            </div>
                        </div>

                    </div>

                    <button type="button" class="btn btn-primary mt-4">Обновить</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="{{ asset('assets/js/bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/charts/chart-ecommerce.js') }}"></script>
<script src="{{ asset('assets/js/example-chart.js') }}"></script>
<script src="{{ asset('assets/js/libs/datatable-btns.js') }}"></script>

<!-- tinymce -->
<link rel="stylesheet" href="{{ asset('assets/css/editors/tinymce.css') }}">
<script src="{{ asset('assets/js/libs/editors/tinymce.js') }}"></script>
<script src="{{ asset('assets/js/editors.js') }}"></script>

<script>
    // Code Create Page
    $('#university-select').change(function () {
        let universityID = $(this).val()

        console.log(universityID)
    })

    // DataTable Init @v1.0
    NioApp.DataTable.init = function() {

        NioApp.DataTable('.datatable-init-vuz', {
            responsive: {
                details: true
            },
            language: {
                url: '{{ asset("lang/dataTables.ru.json") }}'
            },
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                target: 1,
                orderable: false
            },
                {
                    target: 2,
                    orderable: false
                },
                {
                    target: 3,
                    orderable: false
                },
            ],
            // buttons: ['copy', 'excel', 'csv', 'pdf'],
            // buttons: ['excel'],
        });

        NioApp.DataTable('.datatable-init-group', {
            responsive: {
                details: true
            },
            language: {
                url: '{{ asset("lang/dataTables.ru.json") }}'
            },
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                target: 0,
                orderable: false
            },
                {
                    target: 1,
                    orderable: false
                },
                {
                    target: 3,
                    orderable: false
                },
                {
                    target: 4,
                    orderable: false
                },
                {
                    target: 5,
                    orderable: false
                },
            ],
            // buttons: ['copy', 'excel', 'csv', 'pdf'],
            // buttons: ['excel'],
        });

        NioApp.DataTable('.datatable-init-codes', {
            searching: false,
            responsive: {
                details: true
            },
            language: {
                url: '{{ asset("lang/dataTables.ru.json") }}'
            },
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                target: 1,
                orderable: false
            },
                {
                    target: 2,
                    orderable: false
                },
                {
                    target: 3,
                    orderable: false
                },
                {
                    target: 4,
                    orderable: false
                },
            ],
            // buttons: ['copy', 'excel', 'csv', 'pdf'],
            // buttons: ['excel'],
        });

        NioApp.DataTable('.datatable-init-students', {
            // searching: false,
            responsive: {
                details: true
            },
            language: {
                url: '{{ asset("lang/dataTables.ru.json") }}'
            },
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                target: 1,
                orderable: false
            },
                {
                    target: 2,
                    orderable: false
                },
                {
                    target: 3,
                    orderable: false
                },
                {
                    target: 4,
                    orderable: false
                },
                {
                    target: 5,
                    orderable: false
                },
                {
                    target: 6,
                    orderable: false
                },
                {
                    target: 7,
                    orderable: false
                },
            ],
            // buttons: ['copy', 'excel', 'csv', 'pdf'],
            // buttons: ['excel'],
        });

        $.fn.DataTable.ext.pager.numbers_length = 7;
    }

    /*
     * Translated default messages for the jQuery validation plugin.
     * Locale: RU (Russian; ??????? ????)
     */
    $.extend($.validator.messages, {
            required: "Обязательное поле",
            remote: "Please fix this field.",
            email: "Please enter a valid email address.",
            url: "Please enter a valid URL.",
            date: "Please enter a valid date.",
            dateISO: "Please enter a valid date ( ISO ).",
            number: "Please enter a valid number.",
            digits: "Please enter only digits.",
            creditcard: "Please enter a valid credit card number.",
            equalTo: "Please enter the same value again.",
            maxlength: $.validator.format("Please enter no more than {0} characters."),
            minlength: $.validator.format("Please enter at least {0} characters."),
            rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
            range: $.validator.format("Please enter a value between {0} and {1}."),
            max: $.validator.format("Please enter a value less than or equal to {0}."),
            min: $.validator.format("Please enter a value greater than or equal to {0}."),
            integer: "Please enter a positive or negative integer.",
            alphanumeric: "Please enter the letters, numbers or underscores.",
            lettersonly: "Please enter only alphabetic characters.",
            letterswithbasicpunc: "Please enter the letters or punctuation.",
            dateRU: "Please type the date in the format 01.12.2014",
            phoneRU: "Please enter a phone number in a format +38XXXXXXXXXX",
            require_from_select: "Please select from the list value",
            equal: "The value entered not match the required",
            require_if_select: $.validator.format('This field must be filled, if selected "{0}".'),
            edrpou: "Please enter the correct code EDRPOU",
            cents_for_dollar: "Please enter the correct number of cents",
            minlength_with_cleaning: $.validator.format("Please enter at least {0} characters."),
            required_with_cleaning: "This field is required."
        });

    NioApp.Validate('.form-validate-vuz', {
        rules: {
            fv_full_name: "required",
            name: "required",
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            fv_full_name: "Обязательное поле",
            name: "Заполните поле",
            timezone: "Выберете часовой пояс",
            email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
            }
        },
        errorElement: "span",
        errorClass: "invalid",
        errorPlacement: function errorPlacement(error, element) {
            if (element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            } else {
                error.appendTo(element.parent());
            }
        }
    });

    NioApp.Picker.init = function() {
        NioApp.Picker.date('.date-picker-vuz');
    };

    ! function(a) {
        a.fn.datepicker.dates.ru = {
            days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
            daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб"],
            daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
            today: "Сегодня",
            clear: "Очистить",
            // format: "dd.mm.yyyy",
            weekStart: 1,
            monthsTitle: "Месяцы"
        }
    }(jQuery);

    $('.date-picker-vuz').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-1d',
        weekStart: 1,
        locale: 'ru',
        language: 'ru'
    });

    var _tinymce_toolbar = '.tinymce-toolbar-text';
    if ($(_tinymce_toolbar).exists()) {
        tinymce.init({
            selector: _tinymce_toolbar,
            content_css: true,
            skin: false,
            branding: false,
            menubar: false,
            toolbar: 'a11ycheck casechange blocks | bold italic '
        });
    }

    window.addEventListener("load", (event) => {

        setTimeout(() => {
            if (document.querySelector('.dt-export-title')) {
                document.querySelector('.dt-export-title').textContent = 'Быстрый экспорт'
            }

            // $.fn.datetimepicker.dates['en'] = {
            //   days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            //   daysShort: ["Sun", "Пон", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            //   daysMin: ["Su", "Пн", "Tu", "We", "Th", "Fr", "Sa", "Su"],
            //   months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            //   monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            //   today: "Today"
            // };
            // $.fn.datetimepicker.dates['ru'] = {
            //   days: ["Sunday", "Понедельник", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            //   daysShort: ["Sun", "Пон", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            //   daysMin: ["Su", "Пн", "Tu", "We", "Th", "Fr", "Sa", "Su"],
            //   months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            //   monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            //   today: "Today"
            // };
            // $.fn.datetimepicker.defaults.language = 'ru';
        }, 100)
    });
</script>

</body>

</html>
