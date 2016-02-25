<div class="navbar navbar-inverse2">
    <div class="navbar-boxed">
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
              <li><a href="{{ route('home') }}">
                {!! Html::image(auth()->user()->retailer->first()->image, '', ['width' => '120']) !!}
              </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              @var $company_id = 0;

              @foreach (auth()->user()->retailer->first()->retailerProducts as $retailerProduct)
                @if ($company_id !== $retailerProduct->companyProduct->company->id)
                  <li><a href="{{ route('home') }}" style="padding: 0;">
                    {!! Html::image($retailerProduct->companyProduct->company->image, '', ['height' => '65']) !!}
                  </a></li>

                  @var $company_id = $retailerProduct->companyProduct->company->id
                @endif
              @endforeach
            </ul>
        </div>
    </div>
</div>