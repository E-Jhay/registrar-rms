<table class="table">
    <thead>
        <tr>
            <th valign="middle">Year-Quarter</th>
            <th valign="middle">Tracking Number</th>
            <th valign="middle">Request Type</th>
            <th valign="middle">Date Received</th>
            <th valign="middle">Title of Request</th>
            <th valign="middle">Extension?</th>
            <th valign="middle">Status</th>
            <th valign="middle">Date Finished</th>
            <th valign="middle">Days Lapsed</th>
            <th valign="middle">Cost</th>
            <th valign="middle">Appeal/s filed</th>
            <th valign="middle">Remarks</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($report as $key => $value)
          @foreach ($value as $subKey => $subValue)
            <tr>
              <td>{{$quarter. " " .$year}}</td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                  {{$subSubValue['ctr_no']}}<br>
                @endforeach
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                  {{$documentCode[$subSubValue['request_type']]}}<br>
                @endforeach
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                {{$subSubValue['date_received']}}<br>
                @endforeach
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                {{$documentType[$subSubValue['title_of_request']]}}<br>
                @endforeach
                of {{$key}}
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                {{$subSubValue['extension']}}<br>
                @endforeach
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                {{$status[$subSubValue['status']]}}<br>
                @endforeach
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                  {{$subSubValue['date_finished']}}<br>
                @endforeach
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                {{$subSubValue['days_lapsed']}}<br>
                @endforeach
              </td>
              <td>
                {{$costPerCustomer[$key][$subKey]['cost']}}
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                {{$subSubValue['appeals']}}<br>
                @endforeach
              </td>
              <td>
                @foreach ($subValue as $subSubKey => $subSubValue)
                {{$subSubValue['remarks']}}<br>
                @endforeach
              </td>
            </tr>
          @endforeach
      @endforeach
    </tbody>
</table>