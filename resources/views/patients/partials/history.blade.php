<br>
<div class="col-md-12">
    <h4>Historial de Citas</h4>
    <ul class="timeline list-wrapper">

        @forelse($datos as $dato)
            <li class="list-item" style="margin-bottom: -15px">
                <div class="row">
                    <div class="col-md-7">
                        <p class="text-primary">Fecha {{Carbon\Carbon::parse($dato->start)->formatLocalized('%d %B %Y')}}</p>
                        <p style="margin-top: -15px">Lugar: {{$dato->description}}</p>
                    </div>

                    <div class="col-md-5 small">
                        <p class="text-right text-primary">Creada el: &nbsp {{Carbon\Carbon::parse($dato->create_at)->formatLocalized('%d %B %Y %H:%M')}}</p>
                        <p class="text-right" style="margin-top: -15px">Hora de inicio: {{Carbon\Carbon::parse($dato->start)->formatLocalized('%H:%M')}}</p>
                        <p class="text-right" style="margin-top: -15px">Termina a las:&nbsp {{Carbon\Carbon::parse($dato->end)->formatLocalized('%H:%M')}}</p>
                    </div>
                </div>
                <hr style="padding-bottom: 10px !important;margin-top: -3px ">
            </li>
        @empty

        @endforelse
    </ul>
    <div class="m-4">
        <div id="pagination-container"></div>
    </div>
</div>
