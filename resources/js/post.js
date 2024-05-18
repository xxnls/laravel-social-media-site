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
