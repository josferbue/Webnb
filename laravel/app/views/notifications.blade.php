@if (count($errors->all()) > 0)


<div class="alert alert-danger alert-dismissible callout callout-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-ban"></i> Error</h4>

	Por favor, revise los errores de los campos del formulario.

</div>

@endif



@if ($message = Session::get('success'))


<div class="alert alert-success alert-dismissible callout callout-success">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i> Correcto.</h4>

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

<div class="alert alert-danger alert-dismissible callout callout-danger">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-ban"></i> Error.</h4>

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

<div class="alert alert-warning alert-dismissible callout callout-warning">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-warning"></i> Warning.</h4>


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

<div class="alert alert-info alert-dismissible callout callout-info">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-info"></i> Info.</h4>

    @if(is_array($message))

    @foreach ($message as $m)

    {{ $m }}

    @endforeach

    @else

    {{ $message }}

    @endif

</div>

@endif

