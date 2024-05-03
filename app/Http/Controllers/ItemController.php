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
    // public function index()
    // {
    //     // 商品一覧取得
    //     $items = Item::all();

    //     return view('item.index', compact('items'));
    //     $items = Item::select('id', 'user_id', 'title', 'category', 'detail', 'updated_at' )->get();
    
    //     return view('item.index', ['item' => $items]);
    // }
    public function index()
    {
        // 商品一覧取得
        $items = Item::select('id', 'user_id', 'name', 'type', 'detail', 'updated_at')->get();
    
        return view('item.index', compact('items'));
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
        $item=Item::find($id)->first();
        return view('item.edit', compact('item')); // 編集フォームのビューを表示

    }
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'required|max:100',
            'category' => 'required',
            'detail' => 'required',
        ],[
            'title.required' => 'タイトルは必須です。',
            'category.required' => '種別は必須項目です。',
            'detail.required' => '詳細は必須項目です。'
        ]);

        // エラー出る
        $item->update([
            'title' => $request->title,
            'category' => $request->category,
            'detail' => $request->detail,
            'user_id'=> 1
        ]);
        return redirect('/items')->with('success', '情報が更新されました。');
    }

}
