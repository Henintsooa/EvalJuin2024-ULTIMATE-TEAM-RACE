@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement par étape</h5>
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
                      <h6 class="fw-semibold mb-0">Point étape 1 </h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Point étape 2 </h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Point étape 3 </h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($classementGeneraleEtapes as $classementGeneraleEtape)
                  <tr>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->classementgeneral }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomequipe }}</p>
                      </td>
                      <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->pointsetape1 }} </p>
                      </td>
                      <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $classementGeneraleEtape->pointsetape2  }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">{{ $classementGeneraleEtape->pointsetape3  }}</p>
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
                <h5 class="card-title fw-semibold mb-4">Classement général</h5>
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


      </div>  
</body>

</html>
@endsection