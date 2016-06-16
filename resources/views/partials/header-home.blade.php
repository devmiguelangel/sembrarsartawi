<div class="navbar navbar-inverse2">
    <div class="navbar-boxed">
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('home') }}">
                        {!! Html::image(auth()->user()->retailerUser->retailer->image, '', ['width' => '120']) !!}
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @var $company = [];
                @foreach (auth()->user()->retailerUser->retailer->retailerProducts as $retailerProduct)
                    @if (! in_array($retailerProduct->companyProduct->company->id, $company, true))
                        <li>
                            <a href="{{ route('home') }}" style="padding: 0;">
                                {!! Html::image($retailerProduct->companyProduct->company->image, '', ['height' => '65']) !!}
                            </a>
                        </li>

                        <?php array_push($company, $retailerProduct->companyProduct->company->id) ?>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>