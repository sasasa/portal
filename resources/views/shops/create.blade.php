@extends('layouts.app')
@section('title', '店舗新規登録する')

@section('content')
<form action="/shops" method="post">
  @csrf
  <div class="form-group">
    <label for="shop_name">{{__('validation.attributes.shop_name')}}:</label>
    <input type="text" id="shop_name" name="shop_name" value="{{old('shop_name')}}" class="form-control @error('shop_name') is-invalid @enderror">
    @error('shop_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="prefecture">{{__('validation.attributes.prefecture')}}:</label>
    {{ Form::select('prefecture', [
      ''=>'都道府県を選択してください',
      '北海道'=>'北海道',
      '青森県'=>'青森県',
      '岩手県'=>'岩手県',
      '宮城県'=>'宮城県',
      '秋田県'=>'秋田県',
      '山形県'=>'山形県',
      '福島県'=>'福島県',
      '茨城県'=>'茨城県',
      '栃木県'=>'栃木県',
      '群馬県'=>'群馬県',
      '埼玉県'=>'埼玉県',
      '千葉県'=>'千葉県',
      '東京都'=>'東京都',
      '神奈川県'=>'神奈川県',
      '新潟県'=>'新潟県',
      '富山県'=>'富山県',
      '石川県'=>'石川県',
      '福井県'=>'福井県',
      '山梨県'=>'山梨県',
      '長野県'=>'長野県',
      '岐阜県'=>'岐阜県',
      '静岡県'=>'静岡県',
      '愛知県'=>'愛知県',
      '三重県'=>'三重県',
      '滋賀県'=>'滋賀県',
      '京都府'=>'京都府',
      '大阪府'=>'大阪府',
      '兵庫県'=>'兵庫県',
      '奈良県'=>'奈良県',
      '和歌山県'=>'和歌山県',
      '鳥取県'=>'鳥取県',
      '島根県'=>'島根県',
      '岡山県'=>'岡山県',
      '広島県'=>'広島県',
      '山口県'=>'山口県',
      '徳島県'=>'徳島県',
      '香川県'=>'香川県',
      '愛媛県'=>'愛媛県',
      '高知県'=>'高知県',
      '福岡県'=>'福岡県',
      '佐賀県'=>'佐賀県',
      '長崎県'=>'長崎県',
      '熊本県'=>'熊本県',
      '大分県'=>'大分県',
      '宮崎県'=>'宮崎県',
      '鹿児島県'=>'鹿児島県',
      '沖縄県'=>'沖縄県',
    ], old('prefecture'), empty($errors->first('prefecture')) ? ['class'=>"form-control", 'id'=>'prefecture'] : ['class'=>"form-control is-invalid", 'id'=>'prefecture']) }}
    @error('prefecture')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="district">{{__('validation.attributes.district')}}:</label>
    {{-- <select name="district" id="district" class="form-control @error('shop_name') is-invalid @enderror">
      <option value="">市区町村を選択してください</option>
    </select> --}}

    {{ Form::select('district', [
      ''=>'市区町村を選択してください',
    ], old('district'), empty($errors->first('district')) ? ['class'=>"form-control", 'id'=>'district'] : ['class'=>"form-control is-invalid", 'id'=>'district']) }}
    @error('district')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="location">{{__('validation.attributes.location')}}:</label>
    <input type="text" id="location" name="location" value="{{old('location')}}" class="form-control @error('location') is-invalid @enderror">

    @error('location')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="phone_number">{{__('validation.attributes.phone_number')}}:</label>
    <input type="text" id="phone_number" name="phone_number" value="{{old('phone_number')}}" class="form-control @error('phone_number') is-invalid @enderror">
    @error('phone_number')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="shop_mail">{{__('validation.attributes.shop_mail')}}:</label>
    <input type="text" id="shop_mail" name="shop_mail" value="{{old('shop_mail')}}" class="form-control @error('shop_mail') is-invalid @enderror">

    @error('shop_mail')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="url">{{__('validation.attributes.url')}}:</label>
    <input type="text" id="url" name="url" value="{{old('url')}}" class="form-control @error('url') is-invalid @enderror">
    @error('url')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="description">{{__('validation.attributes.description')}}:</label>
    <textarea rows="5" id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <input type="submit" value="登録する" class="btn btn-sm btn-primary">
</form>
@endsection


@section('script')
<script type="module">
$(function() {
  if ($("#prefecture").val() != '') {
    district_fill();
  }
  $("#prefecture").change(function() {
    district_fill();
  });

  function district_fill() {
    $('#district > option').remove();
    // alert($(this).val())
    var json1 = {
      "prefecture": $("#prefecture").val(),
		};
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      url:"/p/json/" + $("#prefecture").val(),
      type:"post",
      contentType: "application/json",
      data:JSON.stringify(json1),
      dataType:"json",
      }).done(function(data1, textStatus, jqXHR) {
        // alert(jqXHR.status);
        // alert(JSON.stringify(data1.places));
        // alert(JSON.stringify(data1));
        $('#district').append($('<option>').html('市区町村を選択してください').val(''));
        $(data1.places).each(function(idx, e) {
          $('#district').append($('<option>').html(e).val(e));
        })
      }).fail(function(jqXHR, textStatus, errorThrown){
        // alert("err:" + jqXHR.status);
        // alert(textStatus);
        // alert(errorThrown);
      }).always(function(){
      });
  }
});
</script>
@endsection