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
                                        <a href="{{ route('admin.home.slide.add') }}"
                                            class="btn btn-success float-end ">add new Slider</a>
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
                                            <th>imagen</th>
                                            <th>TopTitle</th>
                                            <th>Title</th>
                                            <th>SubTitle</th>
                                            <th>Offer</th>
                                            <th>Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            // ($slider->currentPage() - 1) * $slider->perPage(); //para el contador
                                        @endphp
                                        @foreach ($slider as $slide)
                                            <tr>
                                                <th>{{ ++$i }}</th>
                                                <th><img src="{{asset('assets/imgs/slider')}}/{{ $slide->image }}" width="80"> </th>
                                                <th>{{ $slide->top_title }}</th>
                                                <th>{{ $slide->title }}</th>
                                                <th>{{ $slide->sub_title }}</th>
                                                <th>{{ $slide->offer }}</th>
                                                <th>{{ $slide->link }}</th>
                                                <th>{{ $slide->status }}</th>
                                                <td>
                                                    <a href="{{ route('admin.home.slider.edit', ['slide_id' => $slide->id]) }}"
                                                        class="text-info">Edit</a>
                                                    <a href="#" class="text-danger"
                                                        onclick="deleteConfirmation({{ $slide->id }})"style="margin-left: 20px">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $slider->links() }} --}}
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
                        <button type="button" class="btn btn-danger" onclick="deleteSlade()">Eliminar</button>
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
            @this.set('slide_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteSlade() {
            @this.call('deleteSlade');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
