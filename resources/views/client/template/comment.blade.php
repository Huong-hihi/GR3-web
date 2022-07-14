<li>
    <div class="inner">
        <div class="comment-user-info">
            <div class="comment-user-avatar" style="background-image: url('{{ $comment->user->avatar ?? asset('images/default-user-image.png') }}')"></div>
            <span class="comment-user-name">{{ $comment->user->name }}</span>
            <span class="comment-user-publish-time">{{ $comment->created_at }}</span>
        </div>
        <div class="comment-user-body">
            {!! nl2br($comment->content) !!}
        </div>
        <span class="comment-reply">Reply</span>
    </div>
</li>
