@if (count($errors->all()) > 0)

<div class="alert alert-danger alert-block">

	<h4 style="color: #dc5957;">Error</h4>

	Por favor, revise los errores de los campos del formulario.

</div>

@endif



@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">


	<h4>Correcto.</h4>

    @if(is_array($message))

        @foreach ($message as $m)

            {{ $m }}

        @endforeach

    @else

        {{ $message }}

    @endif

</div>

@endif



@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">


	<h4>Error</h4>

    @if(is_array($message))

    @foreach ($message as $m)

    {{ $m }}

    @endforeach

    @else

    {{ $message }}

    @endif

</div>

@endif



@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-block">


	<h4>Warning</h4>

    @if(is_array($message))

    @foreach ($message as $m)

    {{ $m }}

    @endforeach

    @else

    {{ $message }}

    @endif

</div>

@endif



@if ($message = Session::get('info'))

<div class="alert alert-info alert-block">


	<h4>Info</h4>

    @if(is_array($message))

    @foreach ($message as $m)

    {{ $m }}

    @endforeach

    @else

    {{ $message }}

    @endif

</div>

@endif

