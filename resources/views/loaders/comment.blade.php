<?php foreach($comments as $comment){ ?>
<div class="commentsbox">
    @if(file_exists('public/users/'.$comment['user_id'].'.jpg'))
        <div class="commentimages" style="background-image: url({{ URL::asset('public/users/'.$comment['user_id'].'.jpg') }})"></div>
    @else
        <div class="commentimages" style="background-image: url({{ URL::asset('public/users/default.jpg') }})"></div>

    @endif
    <div class="commentimages" style="background-image: url('<?php echo ('public/'.$comment['user_id']); ?>"></div>
    <h4><?php echo $comment['userName']; ?></h4>
    <p><?php echo $comment['text']; ?></p>


        @if($comment['track_id'] != null)
            <iframe src='https://embed.spotify.com/?uri=spotify:track:{{$comment['track_id']}}' height="80px" frameborder='0' allowtransparency='true'></iframe>
        @endif
    <p class="time"> <img src="<?php echo URL::asset('public/images/time.png'); ?>"><?php echo $comment['time']; ?></p>
        {{--@if(session::get('UserInfo')['id'] == $comment['user_id'])--}}
            {{--<a class="delete_button_comment" id = {{$comment['id']}}> delete </a>--}}
        {{--@endif--}}
</div>
<?php } ?>