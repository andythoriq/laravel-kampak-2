<div id="{{ $id }}" class="container-login" style="display: none">
    <center>
        <b>{{ $title }}</b>
        {{-- <x-alert /> --}}
    </center>

    <form action="{{ $route }}" method="POST">
        @csrf
        <table>
            <tr>
                <td width="25%"><b>{{ $unique_field_label }}</b></td>
                <td width="25%" style="text-align: right">
                    <input type="text" name="{{ $unique_field_name }}" maxlength="25" required />
                </td>
            </tr>
            <tr>
                <td width="25%"><b>Password</b></td>
                <td width="25%" style="text-align: right">
                    <input type="password" name="password" maxlength="10" required />
                </td>
            </tr>
        </table>

        <button type="submit" class="button-submit">Login</button>
    </form>
</div>
