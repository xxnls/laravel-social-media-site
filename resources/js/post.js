function deletePost(event)
        {
            let a = this;

            $.ajax({
                    url:"/posts/" + this.dataset.id + "/ajax",
                    method:"DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function()
                    {
                        a.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
                    }
                });
        }