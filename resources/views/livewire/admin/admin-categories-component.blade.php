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
                    <span></span> All Categories
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
                                        All Categories
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.category.add') }}"
                                            class="btn btn-success float-end ">add new Categories</a>
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
                                            <th>Image</th>
                                            <th>Nombre</th>
                                            <th>Slug</th>
                                            <th>Popular</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = ($categories->currentPage() - 1) * $categories->perPage();
                                        @endphp
                                        @foreach ($categories as $category)
                                            <tr>
                                                <th>{{ ++$i }}</th>
                                                <th><img src="{{ asset('assets/imgs/categories')}}/{{ $category->image }}"width='60'></th>
                                                <th>{{ $category->name }}</th>
                                                <th>{{ $category->slug }}</th>
                                                <th>{{ $category->is_popular == 1 ? 'SI' : 'No' }}</th>
                                                <td>
                                                    <a href="{{ route('admin.category.edit', ['category_id' => $category->id]) }}"
                                                        class="text-info">Edit</a>
                                                    <a href="#" class="text-danger"
                                                        onclick="deleteConfirmation({{ $category->id }})"style="margin-left: 20px">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $categories->links() }}
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
                        <button type="button" class="btn btn-danger" onclick="deleteCategory()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id) {
            //   Livewire.emit('deleteCategory', id);
            @this.set('category_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteCategory() {
            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
