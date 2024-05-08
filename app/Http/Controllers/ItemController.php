<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * 商品一覧
     */
    public function index() //リソースの一覧を表示するためのメソッド（GETリクエスト）
    {
        // $items = Item::select('id', 'user_id', 'name', 'type', 'detail', 'updated_at')->get();
        $items = Item::all();
        $typeNames = [
            1 => '小説',
            2 => '新書',
            3 => '雑誌',
            4 => 'エッセイ',
            5 => 'コミックス',
            6 => 'その他',
        ];
    
        return view('item.index', ['items' => $items, 'typeNames' => $typeNames]);
    }
    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'detail' => 'required|max:500',
            ]);
            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);
            return redirect('/items');
        }
        return view('item.add');
    }
    /**
     * 書籍編集フォームを表示する
     */
    public function edit($id)
    {
        $item=Item::find($id);
        return view('item.edit', compact('item')); // 編集フォームのビューを表示
    }
    // 書籍更新
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'detail' => 'required|max:500',
        ],[
            'name.required' => 'タイトルは必須です。',
            'type.required' => '種別は必須項目です。',
            'detail.required' => '詳細は必須項目です。'
        ]);
        // エラー出る
        $item->update([
            'name' => $request->name,
            'type' => $request->type,
            'detail' => $request->detail,
            'user_id'=> 1
        ]);
        return redirect('/items')->with('success', '情報が更新されました。');
    }
        // データ削除する
        public function delete($id)

    {
        // 削除処理を実装する
        $item = Item::findOrFail($id);
        $item->delete();
        
        // 削除後、リダイレクトなどの処理を行う
        return redirect('/items')->with('success', '商品が削除されました');
    }
    }





