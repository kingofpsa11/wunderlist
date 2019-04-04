<li class="section-item section-item-comment" rel="{{ $comment->id }}">
    <div class="section-icon-picture">
        <div class="avatar medium">
            <img src="" alt="">
        </div>
    </div>
    <div class="section-content">
        <span class="comment-author">{{ $user->name }}</span>
        <span class="comment-time">{{ $comment->time }}</span>
        <div class="comment-text">{{ $comment->content }}</div>
    </div>
</li>