<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
            // XSS 过滤
            $content = clean($request->get('content'));
            if (empty($content)) {
                return redirect()->back()->with('danger', '回复内容错误！');
            }

            $reply->content = $content;
            $reply->user_id = Auth::id();
            $reply->topic_id = $request->get('topic_id');
            $reply->save();

            return redirect($reply->topic->link())->with('success', '创建成功！');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        return redirect()->route('replies.index')->with('success', '评论删除成功！');
    }
}
