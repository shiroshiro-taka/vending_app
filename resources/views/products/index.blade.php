@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品一覧画面</h1>


    <div class="search mt-5">
        <form action="{{ route('products.index') }}" method="GET" class="row g-3">
            <div class="col-sm-12 col-md-3">
                <input type="text" name="searchWord" class="form-control" placeholder="検索キーワード" value="{{ $searchWord }}">
            </div>
            <div class="col-sm-12 col-md-3">
                <select class="form-control" name="companyId" value="{{ $companyId}}">
                    <option value="">メーカー名</option>
                    @foreach($companies as $id => $company_name)
                        <option value="{{ $id }}">
                            {{ $company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-3">
                <input type="number" name="min_price" class="form-control" placeholder="最小価格" value="{{ request('min_price') }}">
            </div> 
            <div class="col-sm-12 col-md-3">
                <input type="number" name="max_price" class="form-control" placeholder="最大価格" value="{{ request('max_price') }}">
            </div>
            <div class="col-sm-12 col-md-3">
                <input type="number" name="min_stock" class="form-control" placeholder="最小在庫" value="{{ request('min_stock') }}">
            </div>
            <div class="col-sm-12 col-md-3">
                <input type="number" name="max_stock" class="form-control" placeholder="最大在庫" value="{{ request('max_stock') }}">
            </div>                           
            <div class="col-sm-12 col-md-1">
                <button class="btn btn-outline-secondary" type="submit">検索</button>
            </div>
        </form>
    </div>
    
    <div class="card products mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@sortablelink('id', 'ID')</th>
                    <th>商品画像</th>
                    <th scope="col">@sortablelink('product_name', '商品名')</th>
                    <th scope="col">@sortablelink('price', '価格')</th>
                    <th scope="col">@sortablelink('stock', '在庫数')</th>
                    <th scope="col">@sortablelink('company_name', 'メーカー名')</th>
                    <th><a href="{{ route('products.create') }}" class="btn btn-warning mb-1">新規登録</a></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>￥{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm mx-1">詳細</a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mx-1" onclick='return confirm("削除しますか？");'>削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
      <div class="d-flex justify-content-center">
        {{ $products->appends(request()->query())->links() }}
      </div>
</div>
@endsection      