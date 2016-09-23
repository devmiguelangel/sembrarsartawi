@if($query_header->slug_credit_product=='PMO')
    @include('cert.'.$code_product.'.hipotecario')
@else
    @foreach($query_parameter as $data_parameter)
        @if($data_parameter->slug=='FC')
            @var $amount_max = $data_parameter->amount_max
        @endif
    @endforeach
    @if($query_header->currency=='USD')
        @var $monto_solicitado = $query_header->amount_requested*$query_exchange->bs_value
    @elseif($query_header->currency=='BS')
        @var $monto_solicitado = $query_header->amount_requested
    @endif
    @if($monto_solicitado>$amount_max)
        @include('cert.'.$code_product.'.desgravamen')
    @else
        @include('cert.'.$code_product.'.vidagrupo')
    @endif
@endif
