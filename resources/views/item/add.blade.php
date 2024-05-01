@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="種別">
                                <select name="category" id="category">
                                    <option value=""  ></option>
                                    <option value="1" @if( old('type',$item->type) ==1) selected @endif >小説</option>
                                    <option value="2" @if( old('type',$item->type) ==2) selected @endif >新書</option>
                                    <option value="3" @if( old('type',$item->type) ==3) selected @endif >雑誌</option>
                                    <option value="4" @if( old('type',$item->type) ==4) selected @endif >エッセイ</option>
                                    <option value="5" @if( old('type',$item->type) ==5) selected @endif >コミックス</option>
                                    <option value="6" @if( old('type',$item->type) ==6) selected @endif >その他</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
