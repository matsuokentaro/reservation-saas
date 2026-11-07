<x-app-layout>

    <x-slot name="header">
        <h2>予約編集</h2>
    </x-slot>

    <div class="p-6">

        <form action="{{ route('reservations.update', $reservation->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>店舗</label><br>

                <select name="shop_id">

                    @foreach($shops as $shop)

                        <option value="{{ $shop->id }}"
                            {{ $reservation->shop_id == $shop->id ? 'selected' : '' }}>
                            {{ $shop->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label>予約者名</label><br>

                <input type="text"
                       name="customer_name"
                       value="{{ $reservation->customer_name }}">
            </div>

            <div class="mb-4">
                <label>予約日時</label><br>

                <input type="datetime-local"
                       name="reserved_at"
                       value="{{ date('Y-m-d\TH:i', strtotime($reservation->reserved_at)) }}">
            </div>

            <button type="submit"
                class="btn btn-primary">
            更新
        </button>

        </form>

    </div>

</x-app-layout>