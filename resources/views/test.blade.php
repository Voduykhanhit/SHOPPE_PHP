<a href="{{ route('duykhanh',['id' => '14','ok'=>'thich']) }}">Nhấp dô đi</a>
@php
    $data = unserialize(Cookie::get("user"));
    echo "<pre>";
    print_r($data["username"]);
@endphp