<div class="overflow-x-auto mb-6">
<table class="min-w-full border border-gray-200 dark:border-gray-700">

    <thead class="bg-gray-100 dark:bg-gray-800">
        <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama Motor</th>
            @foreach($columns as $i => $col)
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400">C{{ $i+1 }}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        @foreach($alternatives as $a)
        <tr>
            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $a->nama_motor }}</td>

            @foreach($columns as $col)
                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white text-center">{{ $a->$col }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>

</table>
</div>