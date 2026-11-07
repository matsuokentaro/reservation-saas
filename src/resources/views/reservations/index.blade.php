<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
        📅 予約管理
        </h2>
    </x-slot>

    <div class="p-6">
        <div style="
            display:flex;
            align-items:center;
            gap:16px;
            margin-bottom:24px;">
            <a href="{{ route('reservations.create') }}"
                class="btn btn-primary">
                予約登録
            </a>
                <form method="GET"
                    action="{{ route('reservations.index') }}"
                    class="flex gap-2">

                    <input
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="予約者名で検索"
                        style="width: 280px;"
                        class="border rounded px-3 py-2"
                    >

                    <button type="submit"
                            class="btn btn-primary">
                        検索
                    </button>
            </form>
        </div>

            <div style="
                display:grid;
                grid-template-columns:repeat(3,1fr);
                gap:16px;
                margin-bottom:24px;
            ">

            <div class="btn btn-primary dashboard-card text-center">
                <div>総予約数</div>
                <div>{{ $totalCount }}件</div>
            </div>

            <div class="btn btn-today dashboard-card text-center">
                <div>本日の予約</div>
                <div>{{ $todayCount }}件</div>
            </div>

            <div class="btn btn-warning dashboard-card text-center">
                <div>予約受付</div>
                <div>{{ $pendingCount }}件</div>
            </div>

            <div class="btn btn-success dashboard-card text-center">
                <div>予約確定</div>
                <div>{{ $confirmedCount }}件</div>
            </div>

            <div class="btn btn-completed dashboard-card text-center">
                <div>来店済み</div>
                <div>{{ $completedCount }}件</div>
            </div>

            <div class="btn btn-cancel dashboard-card text-center">
                <div>キャンセル</div>
                <div>{{ $cancelledCount }}件</div>
            </div>
        </div>

        <table class="table-auto w-full border shadow rounded-lg overflow-hidden">

            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">予約者</th>
                    <th class="border p-2">予約日時</th>
                    <th class="border p-2">状態</th>
                    <th class="border p-2">操作</th>

                </tr>
            </thead>

            <tbody>

            @forelse($reservations as $reservation)

                <tr>
                    <td class="border p-2 text-center">
                        {{ $reservation->id }}
                    </td>

                    <td class="border p-2 text-center">
                        {{ $reservation->customer_name }}
                    </td>

                    <td class="border p-2 text-center">
                        {{ \Carbon\Carbon::parse($reservation->reserved_at)->format('Y/m/d H:i') }}
                    </td>
                    <td class="border p-2 text-center">
                        @if($reservation->status === 'pending')

                        <span class="btn btn-warning">
                            予約受付
                        </span>

                        @elseif($reservation->status === 'confirmed')

                        <span class="btn btn-success">
                            予約確定
                        </span>

                        @elseif($reservation->status === 'completed')

                        <span class="btn btn-completed">
                            来店済み
                        </span>
                        @elseif($reservation->status === 'cancelled')

                        <span class="btn btn-danger">
                            キャンセル
                        </span>

                        @endif
                    </td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('reservations.edit', $reservation->id) }}"
                            class="btn btn-sm btn-primary">
                            編集
                        </a>

                            @if($reservation->status === 'pending')

                            <form
                                action="{{ route('reservations.confirm', $reservation->id) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf

                                <button type="submit"
                                        class="btn btn-success">
                                    確定
                                </button>
                            </form>
                            @endif
                            @if($reservation->status === 'confirmed')

                            <form action="{{ route('reservations.complete', $reservation->id) }}"
                                method="POST"
                                class="inline-block">

                                @csrf

                                <button type="submit"
                                        class="btn btn-completed">
                                    来店済み
                                </button>

                            </form>
                            @endif

                            @if($reservation->status === 'pending'|| $reservation->status === 'confirmed')

                            <form action="{{ route('reservations.cancel', $reservation->id) }}"
                                method="POST"
                                class="inline-block">

                                @csrf

                                <button type="submit"
                                        class="btn btn-cancel"
                                        onclick="return confirm('この予約をキャンセルしますか？')">
                                    キャンセル
                                </button>

                            </form>
                            @endif
                            <form action="{{ route('reservations.destroy', $reservation->id) }}"
                            method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('本当に削除しますか？')">
                                削除
                            </button>
                            </form>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4"
                        class="border p-2 text-center">
                        予約がありません
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</x-app-layout>