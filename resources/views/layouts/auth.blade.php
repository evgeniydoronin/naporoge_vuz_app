<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <!-- Page Title  -->
    <title>Login</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.1.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.1.1') }}">

    <!-- Premade Skin style -->
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-naporoge.css') }}">
</head>

<body class="nk-body bg-white npc-default pg-auth">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            {{ $slot }}
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->

<!-- JavaScript -->
<script src="{{ asset('assets/js/bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script>
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
</script>
</body>
</html>
