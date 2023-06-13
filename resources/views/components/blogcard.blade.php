@props(['blogcard'])
<div class="card">
    <img src="/postimage/{{ $blogcard->thumbnail }}" class="card-img-top" alt="..." />
    <div class="card-body">
        <h3 class="card-title">{{ $blogcard->title }}</h3>
        <p class="fs-6 text-secondary">
            <a href="/?username={{ $blogcard->author->username }}">{{ $blogcard->author->name }} </a>
            <span>- {{ $blogcard->created_at->diffForHumans() }}</span>
        </p>
        <div class="tags my-3">
            <a href="/?category={{ $blogcard->category->slug }}"><span
                    class="badge bg-primary">{{ $blogcard->category->name }}</span></a>

        </div>
        <p class="card-text">
            {{ $blogcard->intro }}
        </p>
        <a href="/firstblog/{{ $blogcard->slug }}" class="btn btn-primary">Read More</a>
    </div>
</div>
