<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 10 Invinite scroll</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Posts</h2>
        <div id="posts-container">
            @include('posts.load');
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let nextPageUrl = '{{$posts->nextPageUrl()}}';
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMorePosts();
                    }
                }
            });

            function loadMorePosts() {
                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    beforeSend: function() {
                        nextPageUrl = '';

                    },
                    success: function(data) {
                        nextPageUrl = data.nextPageUrl;
                        $('#posts-container').append(data.view);
                    },
                    error: function(xhr, status, error) {
                        console.error("error loading more posts:", error);
                    }
                });
            }
        });
    </script>

</body>

</html>