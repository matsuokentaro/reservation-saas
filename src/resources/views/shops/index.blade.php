<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗一覧
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    店舗一覧
                </h3>
                    <div class="mb-4">
                        <a a href="{{ route('shops.create') }}"class="btn btn-primary">
                            店舗登録
                        </a>
                    </div>

                <table class="table-auto w-full border">

                    <thead>
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">店舗名</th>
                            <th class="border p-2">住所</th>
                            <th class="border p-2">電話番号</th>
                            <th class="border p-2">操作</th>
                        </tr>
                    </thead>


                    <tbody>
                    @forelse($shops as $shop)
                        <tr>
                            <td class="border p-2">{{ $shop->id }}</td>
                            <td class="border p-2">{{ $shop->name }}</td>
                            <td class="border p-2">{{ $shop->address }}</td>
                            <td class="border p-2">{{ $shop->phone }}</td>
                            <td class="border p-2">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-warning">
                                    編集
                                    </a>
                                    <form action="{{ route('shops.destroy', $shop->id) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('削除しますか？')">
                                        削除
                                    </button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="border p-2 text-center">
                                店舗が登録されていません
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>