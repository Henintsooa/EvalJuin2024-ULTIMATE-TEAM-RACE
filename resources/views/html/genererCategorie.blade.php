@extends('parent')
@section('main')
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <form method="POST" action="{{ url('/genereCategorie') }}">
                  @csrf
                  <button type="submit" class="btn btn-success ">Générer catégories pour chaque joueur</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
          
      </div>
        
</body>
@endsection
