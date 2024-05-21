function followUser(event) {
    let user = $(this);
    let userId = user.data('id');

    $.ajax({
        url: "/users/" + userId + "/follow",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.isFollowing) {
                $('.followUser[data-id="' + userId + '"]').text('Unfollow').removeClass('btn-light').addClass('btn-success');;
            } else {
                $('.followUser[data-id="' + userId + '"]').text('Follow').removeClass('btn-success').addClass('btn-light');;
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}
