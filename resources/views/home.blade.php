@extends('layouts.app')

@section('content')
<style>
    #gurd {
        height: 100vh;
        width: 100vw;
        z-index: 100;
        background-color: white;
        position: absolute;
        top: 0;
        left: 0;
    }
</style>
<div id="gurd"></div>

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
        document.body.innerHTML = "";
        window.location.href = '/p';
        return(false);
    }

    //------------------------------------
    // メアド確認済み
    //------------------------------------
    if( user.emailVerified ) {
        document.getElementById('gurd').remove()
        alert(`Login Complete! ${user.displayName}さんがログインしました${user.uid}`);
    }
    //------------------------------------
    // メアド未確認
    //------------------------------------
    else {
        user.sendEmailVerification()
        .then(()=>{
            alert(`Send confirm mail ${user.email}宛に確認メールを送信しました`);
            document.body.innerHTML = "";
            window.location.href = '/p';
        })
        .catch((error)=>{
            alert(`[Error] Can not send mail ${user.email}宛に確認メールを送信できませんでした: ${error}`);
            document.body.innerHTML = "";
            window.location.href = '/p';
        });
    }
});
</script>
@endsection
