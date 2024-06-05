@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement général par coureur</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Nom coureur </h6>
                        </th>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Nom equipe</h6>
                        </th>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Total point </h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sommePointJoueurs as $sommePointJoueur)
                        <tr>
                          <td class="">
                          <p class="mb-0 fw-normal"> {{ $sommePointJoueur->nomcoureur }}</p>
                          </td>
                          <td class="">
                            <p class="mb-0 fw-normal"> {{ $sommePointJoueur->nomequipe }}</p>
                          </td>
                          <td class="">
                            <p class="mb-0 fw-normal"> {{ $sommePointJoueur->pointstotal }}</p>
                          </td>
                        </tr>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement par coureur par étape</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Nom etape </h6>
                        </th>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Nom coureur </h6>
                        </th>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Nom equipe</h6>
                        </th>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Total point </h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sommePointEtapes as $sommePointEtape)
                        <tr>
                          <td class="">
                            <p class="mb-0 fw-normal"> {{ $sommePointEtape->nometape }}</p>
                            </td>
                          <td class="">
                          <p class="mb-0 fw-normal"> {{ $sommePointEtape->nomcoureur }}</p>
                          </td>
                          <td class="">
                            <p class="mb-0 fw-normal"> {{ $sommePointEtape->nomequipe }}</p>
                          </td>
                          <td class="">
                            <p class="mb-0 fw-normal"> {{ $sommePointEtape->pointstotal }}</p>
                          </td>
                        </tr>
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