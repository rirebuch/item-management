@extends('adminlte::page')

@section('title', '書籍一覧')

@section('content_header')
    <h1>書籍一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">書籍一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">書籍登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <!-- <table class="table table-hover text-nowrap">  -->
                    <table class="table table-hover text-nowrap">
                            <style>
                            td:nth-child(1) {
                                width: 50px!important;
                            }

                            td:nth-child(2) {
                                width: 200px;
                            }

                            td:nth-child(3) {
                                width: 150px;
                            }

                            td:nth-child(4) {
                                width: 50px!important;
                            }

                            td:nth-child(5) {
                                width: 50px!important;
                            }
                            </style>
                            
                            </tr>
                        <!-- ↑がデザイン決めてる -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>更新日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $typeNames[$item->type] }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>{{ $item->updated_at }}</td>               
                                    <td>
                                <!-- ※編集ボタンを入れる場所 -->
                                        <a href="{{ url('/items/' . $item->id . '/edit') }}" button type="button" class="btn btn-outline-primary">編集</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
<!-- resources/views/books/index.blade.php -->

<form action="{{ route('books.index') }}" method="GET">
    <input type="text" name="query" placeholder="検索">
    <button type="submit">検索</button>
</form>

<ul>
    @foreach ($items as $item)
        <li>{{ $item->title }} - {{ $item->author }}</li>
    @endforeach
</ul>

{{ $items->links() }}