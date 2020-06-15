<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
        <div class="card card-small blog-comments">
            <div class="card-header border-bottom">
                <h6 class="m-0">Super Administrador</h6>
            </div>
            <div class="card-body p-0">
                @foreach($owners as $owner)
            <div class="blog-comments__item d-flex p-3">
                <div class="blog-comments__avatar mr-3">
                <img src="{{ asset($owner->logo) }}" /> </div>
                <div class="blog-comments__content">
                <div class="blog-comments__meta text-muted">
                    <a class="text-secondary" href="{{ url('/' . $owner->slug) }}">{{ $owner->name }}</a> de categoría
                    <a class="text-secondary" href="#">{{ $owner->category ? $owner->category->name : 'Sin Categoría' }}</a>
                </div>
                <p class="m-0 my-1 mb-2 text-muted">Tiene los siguientes permisos</p>
                <div class="blog-comments__actions">
                    <div class="btn-group btn-group-sm">
                    <a href="{{ route('owner.enable.orders', $owner->id) }}" class="btn btn-white {{ ($owner->order_enabled == 1) ? 'active' : '' }}">
                        <span class="text-success">
                        <i class="material-icons">check</i>
                        </span> Pedidos
                    </a>
                    @if($owner->category_owner_id == 7)
                    <a href="{{ route('owner.enable.reservations', $owner->id) }}" class="btn btn-white {{ ($owner->reservations_enabled == 1) ? 'active' : '' }}">
                        <span class="text-dark">
                        <i class="material-icons">edit</i>
                        </span> Reservaciones
                    </a>
                    <a href="{{ route('owner.enable.main_digital', $owner->id) }}" class="btn btn-white {{ ($owner->main_digital_enabled == 1) ? 'active' : '' }}">
                        <span class="text-light">
                        <i class="material-icons">more_vert</i>
                        </span> Menú Digital
                    </a>
                    @endif
                    </div>
                </div>
                </div>
            </div>
            @endforeach
            </div>
            <div class="card-footer border-top">
                <div class="row">
                    <div class="col text-center view-report">
                        <button type="submit" class="btn btn-white">{{ $owners->links() }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
