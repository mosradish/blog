<!-- action check + all check + toggle label -->
@php
    $selectedActions = (array) request('actions', []);
    $isAllChecked = empty($selectedActions);
    $toggleLabel = $isAllChecked ? 'すべてON' : 'すべてOFF';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full place-content-center text-center font-semibold text-xl text-gray-800 dark:text-white">Dashboard</h2>
    </x-slot>

    <h2 class="w-[80%] mx-[10%] place-content-center text-center font-semibold text-xl text-gray-800 dark:text-white">最近のアクティビティ</h2>

    <form method="GET" action="{{ route('dashboard') }}" class="p-2 my-4 w-[80%] mx-[10%] text-gray-900 overflow-hidden">
        <div class="flex flex-wrap gap-4 items-end justify-around">

            <!-- 日付範囲 -->
            <div>
                <label class="text-gray-900 dark:text-white">開始日:</label>
                <input type="date" name="from" value="{{ request('from') }}" class="border-2 border-gray-800 dark:border-gray-400 rounded px-2 py-1">
            </div>
            <div>
                <label class="text-gray-900 dark:text-white">終了日:</label>
                <input type="date" name="to" value="{{ request('to') }}" class="border-2 border-gray-800 dark:border-gray-400 rounded px-2 py-1">
            </div>

            <!-- すべてトグル（先頭） -->
            <div class="w-full mb-4">
                <label class="text-gray-900 dark:text-white block mb-1 font-semibold">アクション種別の全切り替え:</label>
                <label class="flex items-center cursor-pointer select-none" for="toggle-all-actions">
                    <div class="relative">
                        <input type="checkbox" id="toggle-all-actions" class="sr-only" {{ $isAllChecked ? 'checked' : '' }} />
                        <div id="toggle-bg" class="w-10 h-4 rounded-full shadow-inner transition-colors duration-300 {{ $isAllChecked ? 'bg-indigo-600' : 'bg-gray-400' }}"></div>
                        <div id="toggle-dot" class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition-transform duration-300 {{ $isAllChecked ? 'translate-x-full' : 'translate-x-0' }}"></div>
                    </div>
                    <span id="toggle-label-text" class="ml-3 text-gray-700 dark:text-gray-300">{{ $toggleLabel }}</span>
                </label>
            </div>

            <!-- アクション種別 -->
            <div class="w-full">
                <label class="text-gray-900 dark:text-white block mb-1 font-semibold">アクション種別（複数選択可）:</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <!-- ログイン -->
                    <div>
                        <strong class="text-sm text-gray-700 dark:text-gray-300">ログイン</strong>
                        <div class="flex flex-col mt-1">
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="User Logged In"
                                    {{ $isAllChecked || in_array('User Logged In', $selectedActions) ? 'checked' : '' }}>
                                ログイン
                            </label>
                        </div>
                    </div>

                    <!-- 投稿関連 -->
                    <div>
                        <strong class="text-sm text-gray-700 dark:text-gray-300">投稿関連</strong>
                        <div class="flex flex-col mt-1">
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="post_created"
                                    {{ $isAllChecked || in_array('post_created', $selectedActions) ? 'checked' : '' }}>
                                作成
                            </label>
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="post_update"
                                    {{ $isAllChecked || in_array('post_update', $selectedActions) ? 'checked' : '' }}>
                                編集
                            </label>
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="post_deleted"
                                    {{ $isAllChecked || in_array('post_deleted', $selectedActions) ? 'checked' : '' }}>
                                削除
                            </label>
                        </div>
                    </div>

                    <!-- コメント関連 -->
                    <div>
                        <strong class="text-sm text-gray-700 dark:text-gray-300">コメント関連</strong>
                        <div class="flex flex-col mt-1">
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="comment_created"
                                    {{ $isAllChecked || in_array('comment_created', $selectedActions) ? 'checked' : '' }}>
                                作成
                            </label>
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="comment_updated"
                                    {{ $isAllChecked || in_array('comment_updated', $selectedActions) ? 'checked' : '' }}>
                                編集
                            </label>
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="comment_deleted"
                                    {{ $isAllChecked || in_array('comment_deleted', $selectedActions) ? 'checked' : '' }}>
                                削除
                            </label>
                        </div>
                    </div>

                    <!-- いいね関連 -->
                    <div>
                        <strong class="text-sm text-gray-700 dark:text-gray-300">いいね関連</strong>
                        <div class="flex flex-col mt-1">
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="like_created"
                                    {{ $isAllChecked || in_array('like_created', $selectedActions) ? 'checked' : '' }}>
                                いいね
                            </label>
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="like_deleted"
                                    {{ $isAllChecked || in_array('like_deleted', $selectedActions) ? 'checked' : '' }}>
                                取り消し
                            </label>
                        </div>
                    </div>

                    <!-- プロフィール関連 -->
                    <div>
                        <strong class="text-sm text-gray-700 dark:text-gray-300">プロフィール</strong>
                        <div class="flex flex-col mt-1">
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="profile_updated"
                                    {{ $isAllChecked || in_array('profile_updated', $selectedActions) ? 'checked' : '' }}>
                                プロフィール更新
                            </label>
                            <label>
                                <input type="checkbox" class="action-checkbox" name="actions[]" value="profile_deleted"
                                    {{ $isAllChecked || in_array('profile_deleted', $selectedActions) ? 'checked' : '' }}>
                                プロフィール削除
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="flex space-around">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 mr-2 rounded">フィルター</button>

                    <a href="{{ route('dashboard') }}"
                    class="bg-red-500 text-white px-4 py-2 ml-2 rounded">
                        リセット
                    </a>
                </div>
            </div>
        </div>
    </form>

    <ul>
        @forelse($activities as $log)
            <li class="p-2 my-4 w-[80%] mx-[10%] bg-gray-100 dark:bg-gray-800 border-b-2 border-gray-400 dark:border-white text-gray-900 dark:text-gray-100 overflow-hidden">
                {{ $log->created_at->format('Y-m-d H:i') }} -
                {{ $log->user->name ?? 'ゲスト' }}:
                {{ $log->description }}
            </li>
        @empty
            <p class="p-2 my-4 w-[80%] mx-[10%] bg-gray-100 dark:bg-gray-800 border-b-2 border-gray-400 dark:border-white text-gray-900 dark:text-gray-100 overflow-hidden">一致するアクティビティがありません。</p>
        @endforelse
    </ul>

    <!-- Dashboard toggle を外部ファイルで読み込み -->
    <script src="{{ asset('resource/js/dashboard-toggle.js') }}"></script>


</x-app-layout>
