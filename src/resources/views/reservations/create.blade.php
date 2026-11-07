<x-app-layout>

    <x-slot name="header">
        <h2>予約登録</h2>
    </x-slot>

    <div class="p-6">

        <form action="{{ route('reservations.store') }}"
            method="POST">
            
            @csrf

            <div class="mb-4">
                <label>店舗</label><br>

                <select name="shop_id">

                    @foreach($shops as $shop)

                        <option value="{{ $shop->id }}">
                            {{ $shop->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label>予約者名</label><br>

                <input type="text"
                    name="customer_name"
                    class="border p-2">
            </div>

            <div class="mb-4">
                <label>予約日時</label><br>

                <input type="datetime-local"
                    name="reserved_at"
                    class="border p-2">
            </div>

            <button type="submit"
                    class="btn btn-success">
                登録
            </button>

        </form>


    </div>

</x-app-layout>