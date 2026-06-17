@props(['data'])

<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden table-auto">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
                <th class="px-4 py-3 text-sm font-semibold">Tipe</th>

                @if(isset($data['positive']))
                    @foreach(array_keys($data['positive']) as $i => $col)
                        <th class="px-4 py-3 text-center text-sm font-semibold">
                            C{{ $i + 1 }}
                        </th>
                    @endforeach
                @endif
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="bg-white dark:bg-gray-900 divide-y">

            {{-- POSITIVE IDEAL --}}
            <tr>
                <td class="px-4 py-3 font-semibold text-green-600">
                    Ideal (+)
                </td>

                @foreach($data['positive'] ?? [] as $val)
                    <td class="px-4 py-3 text-center">
                        {{ number_format($val, 12) }}
                    </td>
                @endforeach
            </tr>

            {{-- NEGATIVE IDEAL --}}
            <tr>
                <td class="px-4 py-3 font-semibold text-red-600">
                    Ideal (-)
                </td>

                @foreach($data['negative'] ?? [] as $val)
                    <td class="px-4 py-3 text-center">
                        {{ number_format($val, 11) }}
                    </td>
                @endforeach
            </tr>

        </tbody>

    </table>
</div>