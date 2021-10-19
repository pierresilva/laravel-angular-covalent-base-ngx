<html>
<style>
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        vertical-align: baseline;
    }

    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
        display: block;
    }

    body {
        line-height: 1;
    }

    ol, ul {
        list-style: none;
    }

    blockquote, q {
        quotes: none;
    }

    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    body {
        font-family: "Times New Roman", serif;
        margin: 20mm 20mm 30mm 20mm;
    }

    hr {
        page-break-after: always;
        border: 0;
        margin: 0;
        padding: 0;
    }

    td {
        border: solid #0d0d0d 1px;
    }
</style>
<body>
<h2 style="margin-top: 20mm;">
    Acta No. {{str_pad($id, 10, '0', STR_PAD_LEFT)}}<br>
    @if($type == 'council')
        REUNIÓN ORDINARIA CONSEJO DE ADMINISTRACIÓN
    @endif
    @if($type == 'coexistence')
        REUNIÓN CONCILIACIÓN COMITÉ DE CONVIVENCIA
    @endif
    @if(!$type)
        REUNIÓN ORDINARIA
    @endif
</h2>
<h3 style="margin-top: 10mm;">Fecha: {{date('d/m/Y', strtotime($date))}} {{date('H:i', strtotime($hour))}}</h3>

<table style="margin-left: 20mm; margin-top: 10mm; width: 80%;">
    <tr>
        <td>Nombre</td>
        <td>Cargo</td>
        <td>Asistió</td>
    </tr>
    @foreach($coun_meeting_citations as $citation)
        <tr>
            <td>{{$citation['user']['name']}}</td>
            <td>@if($citation['coun_member']){{$citation['coun_member']['name']}}@endif</td>
            <td>@if($citation['attended']) SI @else NO @endif</td>
        </tr>
    @endforeach
</table>

<h3 style="margin-top: 10mm;">ORDEN DEL DÍA</h3>
<div style="margin-top: 10mm;"></div>
@foreach($coun_meeting_agendas as $agenda)
    {{$agenda['order'] + 1}}. <b>{{$agenda['name']}}</b><br>
@endforeach

@if($start_content)
    <div style="margin-top: 10mm;">{!! $start_content !!}</div>
@endif

<h3 style="margin-top: 10mm;">DESARROLLO DE LA REUNIÓN</h3>

<div style="margin-top: 10mm;"></div>
@foreach($coun_meeting_agendas as $agenda)
    <div style="margin-top: 10mm;"></div>
    <h4>{{$agenda['order'] + 1}}. {{$agenda['name']}}</h4><br>
    <div style="margin-top: 10mm;"></div>
    <p>{!! $agenda['content'] !!}</p>
@endforeach

@if($end_content)
    <div style="margin-top: 10mm;">{!! $end_content !!}</div>
@endif

<h3 style="margin-top: 10mm;">FIRMAS:</h3>
<table style="width: 100%; text-align: center; margin-top: 10mm;">
    @foreach($coun_meeting_citations as $citation)

        <tr>
            <td>
                <div style="height: 30mm;">
                    @if($citation['signature'])
                        <img src="{{$citation['signature']}}" style="height: 20mm;">
                    @endif
                </div>
                <div>
                    {{strtoupper($citation['user']['name'])}}<br>
                    @if($citation['coun_member'])<b>{{strtoupper($citation['coun_member']['name'])}}</b>@endif
                </div>
            </td>
        </tr>

    @endforeach
</table>

<script type="text/php">
    if (isset($pdf)) {
        $text = "{PAGE_NUM} / {PAGE_COUNT}";
        $size = 10;
        $font = $fontMetrics->getFont("Verdana");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
        $x = ($pdf->get_width() - $width) / 2;
        $y = $pdf->get_height() - 35;
        $pdf->page_text($x, $y, $text, $font, $size);
    }
</script>

</body>
</html>
