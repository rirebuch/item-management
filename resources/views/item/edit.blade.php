<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍情報編集</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- ここに必要に応じてCSSやJavaScriptのリンクを追加 -->
</head>
    <body>
        <div class="container py-3">
            <h1>書籍情報編集</h1>
            <a href="/items" class="btn btn-outline-secondary btn-sm">戻る</a>
            @if ($errors->any())
            <div class="alert" style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif 
            <!-- フォームのアクションは、更新処理を行うルートに設定。PUTメソッドを使用 -->
            <form action="{{ url('/items/update/' . $item->id) }}" method="post">
                <!-- CSRFトークンを含める -->
                @csrf
                <label for="title">書籍名:</label><br>
                <input type="text" id="title" name="title" value="{{ old('title',$item->title) }}" ><br>

                <label for="category">種別:</label><br>
                <select name="category" id="category">
                <option value=""  ></option>
                    <option value="1" @if( old('category',$item->category) ==1) selected @endif >小説</option>
                    <option value="2" @if( old('category',$item->category) ==2) selected @endif >新書</option>
                    <option value="3" @if( old('category',$item->category) ==3) selected @endif >雑誌</option>
                    <option value="4" @if( old('category',$item->category) ==4) selected @endif >エッセイ</option>
                    <option value="5" @if( old('category',$item->category) ==5) selected @endif >コミックス</option>
                    <option value="6" @if( old('category',$item->category) ==6) selected @endif >その他</option>
                </select>

                <label for="detail">詳細:</label><br>
                <textarea name="detail" id="detail" cols="30" rows="10">{{ old('detail',$item->detail) }}</textarea>

                <input type="submit" value="更新" class="btn btn-primary">
                <!-- class を　btn btn-primary  を使って更新ボタンのデザインを変える方法を要確認-->
            </form>
        
            <form action="{{ url('/items/' . $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            {{-- <button type="submit" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか？')">削除</button> --}}
            <button type="submit" class="btn btn-outline-danger"  onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </body>
</html>

