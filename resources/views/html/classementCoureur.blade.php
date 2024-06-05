@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">
        <h3>Bienvenue {{ Auth::user()->name }}</h3>
        <br>
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement liste des étapes</h5>
                <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="">
                      <h6 class="fw-semibold mb-0">Rang</h6>
                    </th>
                    <th class="">
                      <h6 class="fw-semibold mb-0">Etape</h6>
                    </th>
                    <th class="">
                      <h6 class="fw-semibold mb-0">Longueur</h6>
                    </th>
                    <th class="">
                      <h6 class="fw-semibold mb-0">Nbr de coureur autorisé</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($etapes as $etape)
                  <tr>
                      <td class="">
                        <p class="mb-0 fw-normal">Etape {{ $etape->rang }}</p>
                      </td>
                      <td class="">
                        <p class="mb-0 fw-normal"> {{ $etape->nometape }}</p>
                      </td>
                      <td class="">
                          <p class="mb-0 fw-normal"> {{ $etape->longueur }} km</p>
                      </td>
                      <td class="">
                          <p class="mb-0 fw-normal">{{ $etape->nbcoureur  }}</p>
                      </td>

                      <td class="">
                        <a href="{{route('classementCoureurEtape', ['idetape' => $etape->idetape]) }}" class="btn btn-primary btn-sm">Résultats par coureur</a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
        <div>
          
      </div>  
</body>
</html>
@endsection