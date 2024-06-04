@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        {{-- <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement général</h5>
                <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Classement</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Coureur</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Total point </h6>
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($classementGeneraleCoureurs as $classementGeneraleCoureur)
                  <tr>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> {{ $classementGeneraleCoureur->classementgeneral }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> {{ $classementGeneraleCoureur->nomcoureur }}</p>
                      </td>
                      <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $classementGeneraleCoureur->totalpoints }} </p>
                      </td>
                      
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div> --}}
        {{-- <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100"> 
                  <div class="card-body p-4">
                      <h5 class="card-title fw-semibold mb-4">Points par étape</h5>
                      <div class="table-responsive">
                          @foreach ($classementParEtape as $rangetape => $classements)
                              <h6 class="fw-semibold mb-4">Étape {{ $rangetape }}</h6>
                              <table class="table text-nowrap mb-0 align-middle">
                                  <thead class="text-dark fs-4">
                                      <tr>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Classement</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Coureur</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Equipe</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Points</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Durée</h6>
                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($classements as $classementGeneraleEtape)
                                      <tr>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->classement }}</p>
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomcoureur }}</p>
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomequipe }}</p>
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->points }} </p>
                                          </td>
                                          <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"> --}}
                                              {{-- {{ gmdate('H:i:s', $classementGeneraleEtape->dureeetape) }} --}}
                                              {{-- {{ $classementGeneraleEtape->dureeetape }}
                                            </p>
                                          </td>
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                              <hr> <!-- Ligne de séparation entre les étapes -->
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>
        </div> --}}
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100"> 
                  <div class="card-body p-4">
                      <h5 class="card-title fw-semibold mb-4">Classement général et points par étape</h5>
                      <div class="table-responsive">
                              <table class="table text-nowrap mb-0 align-middle">
                                  <thead class="text-dark fs-4">
                                      <tr>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Etape</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Classement</h6>
                                          </th>
                                        
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Equipe</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Points</h6>
                                          </th>
                                          
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php $currentEtape = null; @endphp
                                      @foreach ($classementGeneraleEquipes as $classementGeneraleEquipe)
                                      <tr>
                                        <td class="border-bottom-0">
                                          @if ($classementGeneraleEquipe->nometape !== $currentEtape)
                                              <p class="mb-0 fw-normal">{{ $classementGeneraleEquipe->rangetape }}-{{ $classementGeneraleEquipe->nometape }}</p>
                                              @php $currentEtape = $classementGeneraleEquipe->nometape; @endphp
                                          @else
                                              <p class="mb-0 fw-normal"></p> <!-- Case vide pour ne pas répéter le nom de l'étape -->
                                          @endif
                                        </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEquipe->classementetape }}</p>
                                          </td>
                                          
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEquipe->nomequipe }}</p>
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEquipe->totalpoints }} </p>
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                              <hr> <!-- Ligne de séparation entre les étapes -->
                      </div>
                  </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100"> 
                  <div class="card-body p-4">
                      <h5 class="card-title fw-semibold mb-4">Classement général coureur et points par étape</h5>
                      <div class="table-responsive">
                              <table class="table text-nowrap mb-0 align-middle">
                                  <thead class="text-dark fs-4">
                                      <tr>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Etape</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Classement</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Coureur</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Equipe</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Points</h6>
                                          </th>
                                          <th class="border-bottom-0">
                                              <h6 class="fw-semibold mb-0">Durée</h6>
                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php $currentEtape = null; @endphp
                                      @foreach ($classementGeneraleEtapes as $classementGeneraleEtape)
                                      <tr>
                                        <td class="border-bottom-0">
                                          @if ($classementGeneraleEtape->nometape !== $currentEtape)
                                              <p class="mb-0 fw-normal">{{ $classementGeneraleEtape->rangetape }}-{{ $classementGeneraleEtape->nometape }}</p>
                                              @php $currentEtape = $classementGeneraleEtape->nometape; @endphp
                                          @else
                                              <p class="mb-0 fw-normal"></p> <!-- Case vide pour ne pas répéter le nom de l'étape -->
                                          @endif
                                        </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->classement }}</p>
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomcoureur }}</p>
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomequipe }}</p>
                                          </td>
                                          <td class="border-bottom-0">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->points }} </p>
                                          </td>
                                          <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">
                                              {{-- {{ gmdate('H:i:s', $classementGeneraleEtape->dureeetape) }} --}}
                                              {{ $classementGeneraleEtape->dureeetape }}
                                            </p>
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                              <hr> <!-- Ligne de séparation entre les étapes -->
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>  
</body>

</html>
@endsection