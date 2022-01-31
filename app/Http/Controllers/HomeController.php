<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Memo::all();
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $exist_tag = Tag::where('name',$data['tag'])->where('user_id',$data['user_id'])->first();
        if(empty($exist_tag['id'])){
            $tag_id = Tag::insertGetId(['name' => $data['tag'], 'user_id' => $data['user_id']]);
        } else {
            $tag_id = $exist_tag['id'];
        }
        //dd($exist_tag);

        //dd($tag_id);
        // POSTされたデータをDB（memosテーブル）に挿入
        // MEMOモデルにDBへ保存する命令を出す

        Memo::insert([
            'content' => $data['content'],
             'user_id' => $data['user_id'],
             'tag_id' => $tag_id,
             'status' => 1
        ]);

        // リダイレクト処理
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $memo = Memo::where('status', 1)->where('id', $id)->where('user_id', $user['id'])->first();
        return view('edit', compact('memo'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        //dd($inputs);
        Memo::where('id', $id)->update(['content' => $inputs['content'], 'tag_id' => $inputs['tag_id']]);
        return redirect()->route('home');
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        //dd($inputs);
        Memo::where('id', $id)->update(['status' => 2]);
        return redirect()->route('home')->with('success', 'メモの削除が完了しました');
    }

    public function mypage()
    {
        return view('mypage');
    }


}
