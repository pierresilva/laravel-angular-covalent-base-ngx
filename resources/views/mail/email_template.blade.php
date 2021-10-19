<!DOCTYPE html>
<html>

<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type"
          content="text/html; charset=UTF-8"/>

    <style type="text/css"
           rel="stylesheet"
           media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead' => 'padding: 20px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',

    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 20px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #F6F6F6; font-size: 12px; line-height: 0.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
<table width="100%"
       cellpadding="0"
       cellspacing="0">
    <tr>
        <td style="{{ $style['email-wrapper'] }}"
            align="center">
            <table width="100%"
                   cellpadding="0"
                   cellspacing="0">
                <!-- Logo -->
                <tr>
                    <td style="{{ $style['email-masthead'] }}">
                        <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}"
                           href="{{config('app.url')}}"
                           target="_blank">

                            <img src="{{config('app.url')}}/img/notification-logo.png"
                                 style="max-height: 120px;"/>

                        </a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td style="{{ $style['email-body'] }}"
                        width="100%">
                        <table style="{{ $style['email-body_inner'] }}"
                               align="center"
                               width="570"
                               cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                                    <!-- Greeting -->
                                    <h1 style="{{ $style['header-1'] }}">{{ $data->subject }}</h1>

                                    <!-- Intro -->
                                    <p style="{{ $style['paragraph'] }}">
                                        Hola {{ $data->name }},
                                    </p>
                                    @foreach ($data->intro_lines as $line)
                                        <p style="{{ $style['paragraph'] }}">
                                            {!! $line !!}
                                        </p>
                                    @endforeach

                                    @if(isset($data->agendas) && count($data->agendas))
                                        <p style="{{ $style['paragraph'] }}">
                                            <b>Orden del día:</b><br>
                                        @foreach($data->agendas as $agenda)
                                            {{($agenda['order'] + 1)}}. {{$agenda['name']}}<br>
                                        @endforeach
                                        </p>
                                    @endif
                                <!-- Link Button -->
                                    @if (isset($data->anchor) && count($data->anchor))
                                        <table style="{{ $style['body_action'] }}"
                                               align="center"
                                               width="100%"
                                               cellpadding="0"
                                               cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    <a href="@if (isset($data->anchor['url'])){{ $data->anchor['url'] }}@endif"
                                                       style="{{ $fontFamily }} {{ $style['button'] }} {{ $style['button--green'] }}"
                                                       class="button"
                                                       target="_blank">@if (isset($data->anchor['text'])){{ $data->anchor['text'] }}@endif</a>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if (isset($data->button) && count($data->button))
                                        <table style="{{ $style['body_action'] }}"
                                               align="center"
                                               width="100%"
                                               cellpadding="0"
                                               cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    <a href="@if (isset($data->button['url'])){{ $data->button['url'] }}@endif"
                                                       style="{{ $fontFamily }} {{ $style['button'] }} {{ $style['button--blue'] }}"
                                                       class="button"
                                                       target="_blank">@if (isset($data->button['text'])){{ $data->button['text'] }}@endif</a>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if (isset($data->outro_lines))
                                        @foreach ($data->outro_lines as $line)
                                            <p style="{{ $style['paragraph'] }}">
                                                {!! $line !!}
                                            </p>
                                    @endforeach
                                @endif
                                <!-- Salutation -->
                                    <p style="{{ $style['paragraph'] }}">
                                        <b>Cordialmente, <br>{{ config('app.name') }}</b>
                                    </p>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color: #169451;">
                        <table style="{{ $style['email-footer'] }}"
                               align="center"
                               width="570"
                               cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                                    <p style="{{ $style['paragraph-sub'] }}">
                                        &copy; {{ date('Y') }} {{ config('app.name') }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
