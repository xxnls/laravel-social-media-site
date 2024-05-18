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

//TO DO: show update form
function showUpdateForm(event)
{
    let post = $(this);

    let editFormHTML = `
    <div class="card-body">
            {{-- Content --}}
            <div class="mb-2">
                <textarea id="content" name="content" class="form-control" aria-label="{{$model->content}}" value="{{$model->content}}">{{$model->content}}</textarea>

                @error('content')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            @if($model->image_path)
            <div class="row text-center">
                <div class="col">
                    <img src="{{ asset('img/posts/' . $model->image_path) }}" class="img-fluid" alt="post image">
                </div>
            </div>
            @endif

            <div class="d-flex mt-2">
                {{-- Edit button --}}
                <div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>

                {{-- Edit image input --}}
                <div>
                    <div>
                        <input type="file" name="image_path" id="image_path" class="form-control" value="{{$model->image_path}}">

                        @error('image_path')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
    </div>
    `;

    $.ajax({
            // url:"/posts/" + this.dataset.id + "/ajax",
            // method:"GET",
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            //hide element, then show edit form
            success:function()
            {
                post.parents().eq(4).hide();
                post.parents().eq(4).after(editFormHTML);
            }
        });

}

//TO DO: update post
function updatePost(event)
{
    let post = $(this);

    $.ajax({
            url:"/posts/" + this.dataset.id + "/ajax",
            method:"GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            //hide element, then show edit form
            success:function()
            {
                console.log("dsadsa");
                post.parentNode.parentNode.parentNode.parentNode.parentNode.hide();
            }
        });
}

// ???
// function init()
// {
//     $(".delete-post").click(deletePost);
//     $(".show-update-form").click(showUpdateForm);
//     $(".update-post").click(updatePost);
// }

function showCommentForm(event) {
    let post = $(this);

    //User that is commenting
    let authUser = post.data('auth');

    let commentFormHTML = `
        <div id="commentFormContainer" class="row mt-3 mx-2">
            <div class="col-md-1"></div> <!-- Spacer -->
            <div class="col-md-1">
                <img src="img/users/${authUser.profile_image_path}" class="rounded-circle border" alt="Profile Image" width="50" height="50">
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
                url: "/posts/" + post.data('id') + "/comments",
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    let commentHTML = `
                        <div class="row mt-3 mx-2">
                            <div class="col-md-1"></div> <!-- Spacer -->
                            <div class="col-md-1">
                                <x-show-profile-image :model="Auth::user()" />
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="short-div">${response.user.first_name} ${response.user.last_name}</div>
                                </div>
                                <div class="row">
                                    <div class="short-div">${response.created_at}</div>
                                </div>
                            </div>
                            <div class="col-auto card card-body" style="border-radius: 20px;">${response.content}</div>
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

