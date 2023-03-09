@if (count($errors))
    <ul style="background: red; color: black; padding: 1rem; list-style: none;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
