<div class="star-rating @if(isset($rating) && $rating>=0) pe-none @endif">
    @for ($i = 5; $i >= 1; $i--)
        <input class="star star-{{ $i }} @if(isset($rating) && $rating>=0) pe-none @endif" id="star-{{ $i }}-{{$id}}" type="radio"
               value="{{ $i }}" required
               @if(isset($rating) && round($rating) == $i) checked @endif
               @if(isset($rating)) disabled @endif
               @if(!isset($rating)) name="star" @endif />
        <label class="star star-{{ $i }}" for="star-{{ $i }}-{{$id}}"></label>
    @endfor
</div>
