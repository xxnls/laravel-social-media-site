@props(['model', 'method'])

@if($method == 'ajax')
    {{-- AJAX method --}}
    <div class="dropdown dropend col-auto">
        <button type="button" class="btn btn-light rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-three-dots"></i>
        </button>
        <div class="dropdown-menu">
            <!-- Dropdown menu links (AJAX) -->
            <a class="dropdown-item" {{--href="{{ route('posts.edit', $model->id) }}"--}}>Edit</a>
            <a class="dropdown-item" {{--href="{{ route('posts.delete', $model->id) }}"--}}>Delete</a>
        </div>
    </div>
@endif

@if($method == 'standard')
    <div class="dropdown dropend col-auto">
        <button type="button" class="btn btn-light rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-three-dots"></i>
        </button>
        <div class="dropdown-menu">
            <!-- Dropdown menu links -->
            <a class="dropdown-item" href="{{$model->id}}/edit">Edit</a>
            <form method="POST" href="{{$model->id}}">
                @csrf
                @method('DELETE')
                <button class="dropdown-item">Delete</button>
            </form>
        </div>
    </div>
@endif
