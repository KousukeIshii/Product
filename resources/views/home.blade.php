@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">あなたのユーザー情報</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>名前</h5><p>{{$user->name}}</p>
                        <h5>GoogleID</h5><p>{{$user->google_id}}</p>
                        <h5>Emailアドレス</h5><p>{{$user->email}}</p>
                        <h5>アクセストークン</h5><p>{{$token}}</p>
                    </div>
                    <textarea id="ba">base64データ</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    window.onload = function() {
        localStorage.setItem('j_token', '{{$token}}');
        const yasu = localStorage.getItem('j_token');
        document.getElementById('ba').innerText = yasu;
    };
</script>
