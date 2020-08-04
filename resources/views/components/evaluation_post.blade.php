<form action="/evaluations" method="post">
  @csrf
  <input type="hidden" name="prefecture" value="{{$prefecture}}">
  <input type="hidden" name="district" value="{{$district}}">
  <input type="hidden" name="shop_id" value="{{$shop->id}}">
  <input type="hidden" name="parent_id" value="{{$parent_id}}">
  <div class="form-group">
    <label for="word_of_mouth">{{$label}}:</label>
    <textarea id="word_of_mouth" class="form-control @error('word_of_mouth') is-invalid @enderror" name="word_of_mouth">{{old('word_of_mouth')}}</textarea>
    @error('word_of_mouth')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">{{$label}}</button>
</form>