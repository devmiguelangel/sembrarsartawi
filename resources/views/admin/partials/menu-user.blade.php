<div class="sidebar-user">
    <div class="category-content">
        <div class="media">
            <span class="form-wizard-count">
                    <i class="icon-list"></i>
            </span>
            <div class="media-body">
                <span class="media-heading text-semibold">
                    {{auth()->user()->full_name}}<br>
                    {{auth()->user()->type->name}}
                </span>
            </div>

            <div class="media-right media-middle">

            </div>
        </div>
    </div>
</div>