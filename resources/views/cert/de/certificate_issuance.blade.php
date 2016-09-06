@if($query_header->slug_credit_product=='PMO')
    @include('cert.'.$code_product.'.hipotecario')
@else
    @include('cert.'.$code_product.'.comercial')
@endif
