<div class="overflow-x-auto">
    <table class="w-full border border-gray-300 dark:border-gray-700 text-sm">

        {{-- HEADER --}}
        <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
            <tr>
                <th class="px-3 py-2 border">No</th>
                <th class="px-3 py-2 border text-left">Nama Motor</th>
                <th class="px-3 py-2 border">EW-TOPSIS</th>
                <th class="px-3 py-2 border">RS-TOPSIS</th>
                <th class="px-3 py-2 border">RR-TOPSIS</th>
                <th class="px-3 py-2 border">ROC-TOPSIS</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="text-gray-800 dark:text-gray-100">
            @foreach($data as $i => $row)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    <td class="px-3 py-2 border text-center">{{ $i + 1 }}</td>
                    <td class="px-3 py-2 border">{{ $row['name'] }}</td>
                    <td class="px-3 py-2 border text-center">{{ $row['ew'] }}</td>
                    <td class="px-3 py-2 border text-center">{{ $row['rs'] }}</td>
                    <td class="px-3 py-2 border text-center">{{ $row['rr'] }}</td>
                    <td class="px-3 py-2 border text-center">{{ $row['roc'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>