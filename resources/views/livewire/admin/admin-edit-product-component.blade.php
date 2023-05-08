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
                    <span></span> Edit Product
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
                                        Edit Product
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.products') }}" class="btn btn-success float-end">All
                                            Product</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form wire:submit.prevent="updateProduct">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Ingrese nueva categoría" wire:model="name"
                                            wire:keyup="generateSlug" />
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug"
                                            placeholder="Ingrese cantidad" wire:model="slug" />
                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="short_description" class="form-label">short Descripcion</label>
                                        <textarea class="form-control" name="short_description" placeholder="Ingrese Ingrese descripcion del producto"
                                            wire:model="short_description"></textarea>
                                        @error('short_description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Descripcion</label>
                                        <textarea class="form-control" name="description" placeholder="Ingrese Descripcion del producto"
                                            wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="regular_price" class="form-label">Precio</label>
                                        <input type="text" class="form-control" name="regular_price"
                                            placeholder="Ingrese cantidad" wire:model="regular_price" />
                                        @error('regular_price')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sale_price" class="form-label"> Sale Precio</label>
                                        <input type="text" class="form-control" name="sale_price"
                                            placeholder="Ingrese cantidad" wire:model="sale_price" />
                                        @error('sale_price')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sku" class="form-label">SKU</label>
                                        <input type="text" class="form-control" name="sku"
                                            placeholder="Ingrese cantidad" wire:model="sku" />
                                        @error('sku')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="regular_price" class="form-label">Stock
                                            Estado</label>
                                        <select class="form-control" wire:model="stock_status">
                                            <option value="instock">Instock</option>
                                            <option value="outofstock">Out ot stock</option>
                                        </select>
                                        @error('stock_status')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="featured" class="form-label">Featured</label>
                                        <select class="form-control" name="featured" wire:model="featured">
                                            <option value="0">No</option>
                                            <option value="1">yes</option>
                                        </select>
                                        @error('featured')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mb-3 mt-3">
                                        <label for="quantity" class="form-label">Cantidad</label>
                                        <input type="text" class="form-control" name="quantity"
                                            placeholder="Ingrese cantidad de producto" wire:model="quantity" />
                                        @error('quantity')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label">Imge</label>
                                        <input type="file" class="form-control" name="image"
                                            placeholder="Ingrese una imagen" wire:model="newimage" />
                                        @if ($newimage)
                                            <img src="{{$newimage->temporaryUrl()}}" wideth="120" alt="">
                                            @else
                                            <img src="{{asset('assets/imgs/products/')}}/{{$image}}" wideth="120" alt="">
                                        @endif
                                        @error('newimage')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="category_id" class="form-label">Categoria</label>
                                        <select class="form-control" name="category_id" id=""
                                            wire:model="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                )
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-end">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
