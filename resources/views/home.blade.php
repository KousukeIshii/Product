@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-8 offset-2">
                    <a class="btn btn-block btn-spa-link" href="spa">
                        <i aria-hidden="true"> 商品一覧画面へ</i>
                    </a>
                </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    window.onload = function() {
        localStorage.setItem('j_token', '{{$token}}');
    };
</script>
