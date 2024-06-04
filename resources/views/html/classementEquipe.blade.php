@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement général par équipe</h5>
                <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Classement</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Equipe</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Total point </h6>
                    </th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($classementGenerales as $classementGenerale)
                  <tr>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> {{ $classementGenerale->classementgeneral }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> {{ $classementGenerale->nomequipe }}</p>
                      </td>
                      <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $classementGenerale->totalpoints }} </p>
                      </td>
                      
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>

        @foreach ($classementGeneraleCategories as $categorie => $classements)
        <div class="row mt-5">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement - Catégorie: {{ $categorie }}</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Classement</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Equipe</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Total points</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($classements as $classement)
                      <tr>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $classement->classement }}</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $classement->nomequipe }}</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $classement->totalpoints }} </p>
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
        @endforeach
      
      </div>  
</body>

</html>
@endsection