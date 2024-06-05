@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100"> 
                  <div class="card-body p-4">
                      <h5 class="card-title fw-semibold mb-4">Classement général, Etape {{ $classementGeneraleEtapes[0]->rangetape }}-{{ $classementGeneraleEtapes[0]->nometape }}</h5>
                      <div class="table-responsive">
                              <table class="table text-nowrap mb-0 align-middle">
                                  <thead class="text-dark fs-4">
                                      <tr>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Classement</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Coureur</h6>
                                          </th>
                                          <th class="">
                                            <h6 class="fw-semibold mb-0">Genre</h6>
                                            </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Equipe</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Points</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Chrono</h6>
                                          </th>
                                          <th class="">
                                            <h6 class="fw-semibold mb-0">Pénalité</h6>
                                            </th>
                                            <th class="">
                                                <h6 class="fw-semibold mb-0">Temps final</h6>
                                            </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($classementGeneraleEtapes as $classementGeneraleEtape)
                                      <tr>
                                        
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->classement }}</p>
                                          </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomcoureur }}</p>
                                          </td>
                                          <td class="">
                                            <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->genre }}</p>
                                            </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomequipe }}</p>
                                          </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->points }} </p>
                                          </td>
                                          <td class="">
                                            <p class="mb-0 fw-normal">
                                              {{ $classementGeneraleEtape->chrono }}
                                            </p>
                                          </td>
                                          <td class="">
                                            <p class="mb-0 fw-normal">
                                              {{ $classementGeneraleEtape->tempspenalite }}
                                            </p>
                                          </td>
                                          <td class="">
                                            <p class="mb-0 fw-normal">
                                              {{ $classementGeneraleEtape->heurefin }}
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