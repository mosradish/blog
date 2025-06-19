<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ★ 最初にクエリビルダを初期化する
        $query = ActivityLog::with('user')->latest();

        // アクション（複数選択）のフィルター
        if ($request->filled('actions')) {
            $query->whereIn('action', $request->input('actions'));
        }

        // 開始日フィルター
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        // 終了日フィルター
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // 単一アクションフィルター（旧式が残っていれば削除してOK）
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // 最大50件取得
        $activities = $query->take(50)->get();

        return view('dashboard', compact('activities'));
    }
}
