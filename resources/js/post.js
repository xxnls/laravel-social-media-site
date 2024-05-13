function deletePost(event)
{
    let post = this;

    $.ajax({
            url:"/posts/" + this.dataset.id + "/ajax",
            method:"DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function()
            {
                post.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
            }
        });
}

function updatePost(event)
{
    let post = this;

    $.ajax({
            url:"/posts/" + this.dataset.id + "/ajax",
            method:"PUT",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            //to do
        });
}