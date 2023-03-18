<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Systeme de like et dislike</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          @auth
          <li class="nav-item">
            <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button class="nav-link btn btn-danger" type="submit">Se déconnecter</button>
            </form>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">S'inscrire</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>  
    <div class="row m-2">
        @foreach ($collections as $item)
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ $item->titre }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $item->user->name }}</h6>
                <p class="card-text">{{ $item->content }}</p>
                
                <form method="post" action="{{ route('posts.like', $item->id) }}">
                  @csrf
                  <button class="btn btn-like"><i class="fa fa-thumbs-up"></i></button>
              </form>
              
                <span>{{ $item->like }}</span>

                <form method="post" action="{{ route('posts.dislike', $item->id) }}">
                  @csrf
                  <button class="btn btn-dislike"><i class="fa fa-thumbs-down"></i></button>
              </form>
                <span>{{ $item->dislike }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        let buttons = document.querySelectorAll('.btn-like, .btn-dislike');

        buttons.forEach(button => {
        let liked = false;
        let disliked = false;

        button.addEventListener('click', function() {
            if (liked && button.classList.contains('btn-primary')) {
            button.classList.remove('btn-primary');
            liked = false;
            } else if (disliked && button.classList.contains('btn-warning')) {
            button.classList.remove('btn-warning');
            disliked = false;
            } else if (!liked && button.classList.contains('btn-like')) {
            button.classList.add('btn-primary');
            liked = true;
        } else if (!disliked && button.classList.contains('btn-dislike')) {
            button.classList.add('btn-warning');
            disliked = true;
            }
        });
        });
        
    </script>
</body>
</html>
