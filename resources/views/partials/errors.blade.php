@if($errors->any())

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    <strong>
                        {{ $error }}
                    </strong>
                </li>
            @endforeach
        </ul>
    </div>

@endif