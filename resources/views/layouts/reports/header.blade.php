<header>
<table dir="ltr">
    <tr class="top">
        <td class="text-left">
            <img src="{{ asset('images/report-logo.png') }}" alt="{{App\Models\Setting::getSetting('site_name')}}" />
        </td>
        <td class="text-right">
            {{ __('report.report_date') }} : {{ date('Y/m/d') }} - {{ date('H:m') }}
        </td>
    </tr>
</table>
<hr>
</header>