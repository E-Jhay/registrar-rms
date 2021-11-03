<table class="table">
    <thead>
        <tr>
            <th>Documents</th>
            @foreach ($departments as $department)
                <th class="text-center">{{$department->name}}</th>
            @endforeach
            <th class="text-center">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $document => $values)
            <tr>
                <td>{{$documentTypes[$document]}}</td>
                @foreach ($departments as $department)
                    <td class="text-center">{{$report[$document][$department->id]['count'] ?? '0'}}</td>
                @endforeach
                <td class="text-center">{{$totalCountPerDocs[$document] ?? '0'}}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center">Total</td>
            <td class="text-center">{{$totalCount}}</td>
        </tr>
    </tbody>
</table>