@if (session()->has('success'))
    <div class="alert alert-success">
        <span class="closebtn" id="closeBtn">&times;</span>
       <b><?= session()->get('success')  ?></b>
    </div>
@elseif (session()->has('danger'))
    <div class="alert alert-danger">
        <span class="closebtn" id="closeBtn">&times;</span>
        <b><?= session()->get('danger')  ?></b>
    </div>
@elseif (session()->has('info'))
    <div class="alert alert-info">
        <span class="closebtn" id="closeBtn">&times;</span>
        <b><?= session()->get('info')  ?></b>
    </div>
@endif
