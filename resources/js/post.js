function deletePost(event)
{
    let post = $(this);

    $.ajax({
            url:"/posts/" + this.dataset.id + "/ajax",
            method:"DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function()
            {
                post.parents().eq(4).remove();
            }
        });
}

function showUpdateForm(event) {
    let post = $(this);

    // Post ID
    let postId = post.data('id');

    let authUser = post.data('auth');
    let imagePath = authUser.profile_image_path ? 'img/users/' + authUser.profile_image_path : 'img/default/default-user.jpg';

    // Fetch the post data using AJAX
    $.ajax({
        url: "/posts/" + postId + "/data",
        method: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Hide the original post content
            post.parents().eq(4).hide();

            // Generate the edit form HTML
            let editFormHTML = `
                <div class="card card-body edit-form">
                    <div class="row">
                        <div class="col-auto">
                            <img src="${imagePath}" class="rounded-circle border" alt="Profile Image" width="50" height="50">
                        </div>

                        <div class="col-auto">
                            <div class="short-div">${authUser.first_name} ${authUser.last_name}</div>
                            <a href="posts/${response.id}" class="short-div link-dark">
                                Go to the post
                            </a>
                        </div>
                    </div>

                    <form id="updatePostForm" data-id="${response.id}">
                        <div class="mb-2 pt-2">
                            <textarea id="content" name="content" class="form-control" aria-label="${response.content}">${response.content}</textarea>
                            <div id="contentError" class="alert alert-danger mt-2" style="display: none;"></div>
                        </div>
                        ${response.image_path ? `
                        <div class="row text-center py-2">
                            <div class="col">
                                <img src="/img/posts/${response.image_path}" class="img-fluid" alt="post image">
                            </div>
                        </div>
                        ` : ''}
                        <div class="d-flex mt-2">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="col-auto">
                                <input type="file" name="image_path" id="image_path" class="form-control" value="${response.image_path}">
                            </div>
                        </div>
                    </form>
                </div>
            `;

            // Append the edit form after the original post container
            post.parents().eq(4).after(editFormHTML);

            // Handle the form submission
            $('#updatePostForm').submit(function(event) {
                event.preventDefault();

                let formData = new FormData(this);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: "/posts/" + postId + "/ajax",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        // Refresh the page or update the post content dynamically
                        location.reload();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.content) {
                            $('#contentError').text(errors.content[0]).show();
                        } else {
                            $('#contentError').hide();
                        }
                    }
                });
            });
        }
    });
}

function showCommentForm(event) {
    let post = $(this);

    //User that is commenting
    let authUser = post.data('auth');

    //Post id
    let postId = post.data('id');

    //Check if user has a profile image
    let imagePath = authUser.profile_image_path ? '/img/users/' + authUser.profile_image_path : '/img/default/default-user.jpg';

    let commentFormHTML = `
        <div id="commentFormContainer" class="row mt-3 mx-2">
            <div class="col-md-1"></div> <!-- Spacer -->
            <div class="col-md-1 mx-3">
                <img src="${imagePath}" class="rounded-circle border" alt="Profile Image" width="50" height="50">
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="short-div">${authUser.first_name} ${authUser.last_name}</div>
                </div>
            </div>
            <div class="col-auto card card-body" style="border-radius: 20px;">
                <form id="commentForm">
                    <textarea id="commentContent" name="content" class="form-control" placeholder="Write a comment..."></textarea>
                    <div id="commentContentError" class="alert alert-danger mt-2" style="display: none;"></div>
                    <div class="d-flex mt-2">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" id="cancelCommentButton" class="btn btn-secondary ms-2">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    `;

    if ($('#commentFormContainer').length === 0) {
        post.closest('.card-body').append(commentFormHTML);

        $('#cancelCommentButton').click(function() {
            $('#commentFormContainer').remove();
        });

        $('#commentForm').submit(function(event) {
            event.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "/posts/" + postId + "/comment",
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    let formattedDate = moment(response.comment.created_at).format('Do [of] MMMM YYYY HH:mm');

                    let commentHTML = `
                        <div class="row mt-3 mx-2">
                            <div class="col-md-1"></div> <!-- Spacer -->
                            <div class="col-md-1 mx-3">
                                <img src="${imagePath}" class="rounded-circle border" alt="Profile Image" width="50" height="50">
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="short-div">${authUser.first_name} ${authUser.last_name}</div>
                                </div>
                                <div class="row">
                                    <div class="short-div">${formattedDate}</div>
                                </div>
                            </div>
                            <div class="col-auto card card-body" style="border-radius: 20px;">${response.comment.content}</div>
                        </div>
                    `;

                    $('#commentFormContainer').before(commentHTML);
                    $('#commentFormContainer').remove();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.content) {
                        $('#commentContentError').text(errors.content[0]).show();
                    } else {
                        $('#commentContentError').hide();
                    }
                }
            });
        });
    }
}

function likePost(event) {
    let post = $(this);
    let postId = post.data('id');

    $.ajax({
        url: "/posts/" + postId + "/like",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('.likeCount[data-id="' + postId + '"]').text(response.likeCount);

            if(response.isLiked) {
                $('.likePost[data-id="' + postId + '"]').removeClass('btn-light').addClass('btn-success');
            } else {
                $('.likePost[data-id="' + postId + '"]').removeClass('btn-success').addClass('btn-light');
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}
