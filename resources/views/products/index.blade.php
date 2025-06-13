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
                <a href="{{route('products.create')}}" class="btn btn-dark">Create</a>
            </div>
            <!-- Display message after user added -->
             @if(Session::has('success'))
             <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
             @endif

             @if(Session::has('error'))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
             @endif
            <div class="card p-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <h4>Products</h4>
                </div>
                <div class="card-body shadow-lg">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th width="100">Status</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- LIST THE PRODUCTS -->
                            @if($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img class="rounded" src="{{ asset('uploads.products/' . $product->image) }}" width="50" alt="{{ $product->name }}">
                                            <!-- <img class="rounded" src="{{ asset('uploads/products/' .$product->image) }}" width="50" alt="404 Error"> -->
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @if($product->status == "active")
                                                <span class="badge bg-success">Active</span>
                                            @else    
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('products.edit',$product->id) }}" class="btn btn-dark btn-sm">Edit</a>

                                            <form action="{{route('products.delete', $product->id)}}" 
                                                method="post"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf 
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No Products Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>