<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 12 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark text-center text-white py-3">
        <h2>Laravel 12 CRUD</h2>
    </div>

    <div class="container">
        <div class="row">
           <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
            </div>
            <div class="card p-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body shadow-lg">
                    <!-- $product->id :- update on behalf of id -->
                   <form action="{{ route('products.update', $products->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$products->name)}}" id="name" name="name" placeholder="Name">
                            <!-- if error comes in name then display it -->
                            @error('name')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <!-- is compulsury to pass is-invaild inside class to display error in bootstrap -->
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                             @error('image')
                                <p class="invalid-feedback">{{$message}}</p>
                             @enderror

                             @if(!empty($product->image))
                               <img class="rounded" src="{{ asset('uploads.products/' . $product->image) }}" width="150" alt="{{ $product->name }}">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" value="{{old('sku',$products->sku)}}" id="sku" name="sku" placeholder="SKU">
                            @error('sku')
                                <p class="invalid-feedback">{{$message}}</p>
                             @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{old('price',$products->price)}}" id="price" name="price" placeholder="Price">
                                @error('price')
                                    <p class="invalid-feedback">{{$message}}</p>
                                 @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status </label>
                                <select name="status" id="status" class="form-select">
                                    <option {{ ($products->status == 'active') ? 'Selected' : '' }} value="Active">Active</option>
                                    <option {{ ($products->status == 'inactive') ? 'Selected' : '' }} value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <button class="btn btn-dark">Update</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>