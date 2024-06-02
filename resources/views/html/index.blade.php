@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">
          <h1>ULTIMATE TEAM RACE</h1>
        <br>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            
            <img src="../assets/images/logos/logo.png" width="700" alt="" /> 
          </div>
        </div>
        <br>
        <!--  Row 1 -->
        <h3>Bienvenue {{ $nomequipe }} </h3>
        <br>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Liste des étapes</h5>
                <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Rang</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Etape</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Longueur</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Nbr de coureur</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($etapes as $etape)
                  <tr>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">Etape {{ $etape->rang }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> {{ $etape->nometape }}</p>
                      </td>
                      <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $etape->longueur }} km</p>
                      </td>
                      <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $etape->nbcoureur  }}</p>
                      </td>
                
                      <td class="border-bottom-0">
                        <a href="{{route('affecterCoureur', ['idEtape' => $etape->idetape,'nbrCoureur' => $etape->nbcoureur]) }}" class="btn btn-primary btn-sm">Affecter coureur</a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100">
                  <div class="card-body p-4">
                      <h5 class="card-title fw-semibold mb-4">Coureurs par étape</h5>
                      <div class="table-responsive">
                          <table class="table text-nowrap mb-0 align-middle">
                              <thead class="text-dark fs-4">
                                  <tr>
                                      <th class="border-bottom-0">
                                          <h6 class="fw-semibold mb-0">Etape</h6>
                                      </th>
                                      <th class="border-bottom-0">
                                          <h6 class="fw-semibold mb-0">Coureur</h6>
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @php $currentEtape = null; @endphp
                                  @foreach ($equipecoureurs as $equipecoureur)
                                      <tr>
                                          <td class="border-bottom-0">
                                              @if ($equipecoureur->nometape !== $currentEtape)
                                                  <p class="mb-0 fw-normal">{{ $equipecoureur->nometape }}</p>
                                                  @php $currentEtape = $equipecoureur->nometape; @endphp
                                              @else
                                                  <p class="mb-0 fw-normal"></p> <!-- Case vide pour ne pas répéter le nom de l'étape -->
                                              @endif
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal">{{ $equipecoureur->nomcoureur }}</p>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      

      </div>  
</body>

</html>
@endsection