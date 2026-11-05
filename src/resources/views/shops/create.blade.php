<x-app-layout>
    <x-slot name="header">
        <h2>店舗登録</h2>
    </x-slot>

    <div class="p-6">

        <form action="{{ route('shops.store') }}"
              method="POST">

            @csrf

            <div class="mb-4">
                <label>店舗名</label><br>
                <input type="text"
                       name="name"
                       class="border">
            </div>

            <div class="mb-4">
                <label>住所</label><br>
                <input type="text"
                       name="address"
                       class="border">
            </div>

            <div class="mb-4">
                <label>電話番号</label><br>
                <input type="text"
                       name="phone"
                       class="border">
            </div>

            <div class="mb-4">
                <label>開店時間</label><br>
                <input type="time"
                       name="open_time">
            </div>

            <div class="mb-4">
                <label>閉店時間</label><br>
                <input type="time"
                       name="close_time">
            </div>

        <button
        type="submit"
        class="bg-red-600 text-white font-bold px-4 py-2 rounded">
        登録
        </button>

        </form>

    </div>
</x-app-layout>