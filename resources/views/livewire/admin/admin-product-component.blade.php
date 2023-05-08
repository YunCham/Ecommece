<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> All Product
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="cart-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Productos
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.product.add') }}"
                                            class="btn btn-success float-end ">add new Products</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Stock</th>
                                            <th>Precio</th>
                                            <th>Categoria</th>
                                            <th>Fecha</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = ($products->currentPage() - 1) * $products->perPage();
                                        @endphp
                                        @foreach ($products as $product)
                                            <tr>
                                                <th>{{ ++$i }}</th>
                                                <th><img src="{{ asset('assets/imgs/products') }}/{{ $product->image }}"
                                                        alt="{{ $product->name }}" width='60'></th>
                                                <th>{{ $product->name }}</th>
                                                <th>{{ $product->stock_status }}</th>
                                                <th>{{ $product->regular_price }}</th>
                                                <th>{{ $product->category->name }}</th>
                                                <th>{{ $product->created_at }}</th>
                                                <td>
                                                     <a href="{{ route('admin.product.edit', ['product_id' => $product->id]) }}"
                                                        class="text-info">Edit</a>
                                                   <a href="#" class="text-danger"
                                                        onclick="deleteConfirmation({{ $product->id }})"style="margin-left: 20px">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

{{-- inicio modal --}}
<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3"> ¿Desea eliminar este registro?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" onclick="deleteProduct()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id) {
            //   Livewire.emit('deleteProduct', id);
            @this.set('product_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteProduct() {
            @this.call('deleteProduct');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush

