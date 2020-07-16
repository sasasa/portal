@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザ{{__('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//認証状態の確認
firebase.auth().onAuthStateChanged( (user) => {

    // firebase.auth().signOut().then(()=>{
    //   console.log("ログアウトしました");
    // })
    // .catch( (error)=>{
    //   console.log(`ログアウト時にエラーが発生しました (${error})`);
    // });

    console.log(user);

    //------------------------------------
    // 未ログイン状態で訪れた場合
    //------------------------------------
    if(user === null){
        alert('Not Login ログインが必要な画面です');
        return(false);
    }

    //------------------------------------
    // メアド確認済み
    //------------------------------------
    if( user.emailVerified ) {
        alert(`Login Complete! ${user.displayName}さんがログインしました${user.uid}`);
    }
    //------------------------------------
    // メアド未確認
    //------------------------------------
    else {
        user.sendEmailVerification()
        .then(()=>{
            alert(`Send confirm mail ${user.email}宛に確認メールを送信しました`);
        })
        .catch((error)=>{
            alert(`[Error] Can not send mail ${user.email}宛に確認メールを送信できませんでした: ${error}`);
        });
    }
});
</script>
@endsection
