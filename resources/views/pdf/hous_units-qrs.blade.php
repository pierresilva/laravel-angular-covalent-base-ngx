<!DOCTYPE html>
<style>
    @page {
        width: 27mm;
        height: 7mm;
        padding: 0.5mm;
    }

    svg {
        height: 40mm;
        width: 40mm;
        display: inline-block;
        vertical-align: middle;
        image-rendering: pixelated;
    }

    .label {
        font-family: Arial, Verdana, Helvetica, sans;
        font-weight: bold;
        vertical-align: middle;
        display: inline-block;
        font-size: 5mm;
        padding-left: 8mm;
    }
</style>

<html>

    <head>

        <title></title>

    </head>

    <body>

        @foreach($sectors as $sector)
            <div style="padding: 6mm; margin: 6mm; border: dotted #222; border-radius: 6mm;">
                {!! QrCode::size(250)->generate($sector->id); !!}
                <div class="label">
                    <span style="color: gray;">Unidad:</span>
                    <br>
                    <span style="text-transform: uppercase;">{{$sector->housUnit->name}}</span>
                    <br>
                    <span style="color: gray;">Sector:</span>
                    <br>
                    <span style="text-transform: uppercase;">{{$sector->name}}</span>
                    <br>
                </div>
            </div>
        @endforeach


    </body>

</html>
