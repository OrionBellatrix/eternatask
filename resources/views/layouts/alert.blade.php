@if($errors->any())
    <div class="alert alert-danger pb-0">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif(session()->has('success'))
    <div class="alert alert-success">
        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
@endif
