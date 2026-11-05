<x-app-layout>
    <x-slot name="header">
        <h2>店舗編集</h2>
    </x-slot>

    <div class="p-6">

        <form action="{{ route('shops.update', $shop) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>店舗名</label><br>
                <input type="text"
                       name="name"
                       value="{{ $shop->name }}"
                       class="border p-2">
            </div>

            <div class="mb-4">
                <label>住所</label><br>
                <input type="text"
                       name="address"
                       value="{{ $shop->address }}"
                       class="border p-2">
            </div>

            <div class="mb-4">
                <label>電話番号</label><br>
                <input type="text"
                       name="phone"
                       value="{{ $shop->phone }}"
                       class="border p-2">
            </div>

            <div class="mb-4">
                <label>開店時間</label><br>
                <input type="time"
                       name="open_time"
                       value="{{ $shop->open_time }}">
            </div>

            <div class="mb-4">
                <label>閉店時間</label><br>
                <input type="time"
                       name="close_time"
                       value="{{ $shop->close_time }}">
            </div>

            <button type="submit"
                    class="btn btn-success">
                更新
            </button>

        </form>

    </div>
</x-app-layout>