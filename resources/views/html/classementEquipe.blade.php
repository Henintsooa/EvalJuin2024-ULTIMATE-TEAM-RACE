@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card w-100"> 
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Classement général par équipe</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Classement</h6>
                        </th>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Equipe</h6>
                        </th>
                        <th class="">
                          <h6 class="fw-semibold mb-0">Total point </h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($classementGenerales as $classementGenerale)
                        <tr>
                          <td class="">
                          <p class="mb-0 fw-normal"> {{ $classementGenerale->classementgeneral }}</p>
                          </td>
                          <td class="">
                          <p class="mb-0 fw-normal"> {{ $classementGenerale->nomequipe }}</p>
                          </td>
                          <td class="">
                          <p class="mb-0 fw-normal"> {{ $classementGenerale->totalpoints }} </p>
                          </td>
                          <td class="">
                          <p class="mb-0 fw-normal"> {{ $classementGenerale->totalpoints }} </p>
                          </td>
                          @if(Auth::user()->status ?? '' == 'admin')
                          @if($loop->first)
                          <td class="">
                            <a href="{{ route('showCertificat',['idequipe' => $classementGenerale->idequipe])}}" class="fw-semibold mb-0 sort-link">Certificat Pdf</a>
                          </td>
                          @endif
                          @endif
                        </tr>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold"></h5>
                  </div>
                  <div>
                    {{-- <select class="form-select">
                      <option value="1">March 2023</option>
                      <option value="2">April 2023</option>
                      <option value="3">May 2023</option>
                      <option value="4">June 2023</option>
                    </select> --}}
                  </div>
                </div>
                <div id="pieChart"></div>
              </div>  
            </div>
          </div>
        </div>
        

        <div class="row mt-5">
          <form action="/classementEquipe" method="get">
            @csrf
            <div class="col-md-3">
              <div class="d-flex align-items-center">
                <select class="form-select me-2" name="nomcategorie" id="nomcategorie">
                  <option value="">Categorie</option>
                  @foreach ($categories as $categorie)
                  <option value="{{ $categorie->nomcategorie }}" {{ old('nomcategorie') == $categorie->nomcategorie ? 'selected' : '' }}>{{ $categorie->nomcategorie }}</option>
                  @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Valider</button>
              </div>
            </div>
          </form>
          <div class="row mt-5">
            <div class="col-lg-6 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Classement - Catégorie: {{ $classementGeneraleCategories[0]->nomcategorie }}</h5>
                  <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                      <thead class="text-dark fs-4">
                        <tr>
                          <th class="">
                            <h6 class="fw-semibold mb-0">Classement</h6>
                          </th>
                          <th class="">
                            <h6 class="fw-semibold mb-0">Equipe</h6>
                          </th>
                          <th class="">
                            <h6 class="fw-semibold mb-0">Total points</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($classementGeneraleCategories as $classement)
                        <tr>
                          <td class="">
                            <p class="mb-0 fw-normal"> {{ $classement->classement }}</p>
                          </td>
                          <td class="">
                            <p class="mb-0 fw-normal"> {{ $classement->nomequipe }}</p>
                          </td>
                          <td class="">
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
            <div class="col-lg-6 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold"></h5>
                    </div>
                    <div>
                      {{-- <select class="form-select">
                        <option value="1">March 2023</option>
                        <option value="2">April 2023</option>
                        <option value="3">May 2023</option>
                        <option value="4">June 2023</option>
                      </select> --}}
                    </div>
                  </div>
                  <div id="pieChart2"></div>
                </div>
              </div>
            </div>
          </div>
          
      
        </div>
        
      </div>  
</body>
<script src="../assets/libs/apexcharts/dist/apexcharts.js"></script>

<script>
  var classementGenerale = @json($classementGenerales);
  console.log(classementGenerale);
  
  var labelsData = classementGenerale.map(function(item) {
    return item.nomequipe;
  });
  var seriesData = classementGenerale.map(function(item) {
    return parseInt(item.totalpoints);
  });
  console.log(labelsData);
  console.log(seriesData);
  // Configuration options for the pie chart
  var options = {
    series: seriesData,
    chart: {
      type: 'pie',
      width: 425,
      height: 425,
    },
    labels: labelsData,
  };
  
  
  // Initialize the pie chart
  var chart = new ApexCharts(document.querySelector("#pieChart"), options);
  chart.render();
</script>
<script>
  var classementGeneraleCategorie = @json($classementGeneraleCategories);
  console.log(classementGeneraleCategorie);
  
  var labelsData = classementGeneraleCategorie.map(function(item) {
    return item.nomequipe;
  });
  var seriesData = classementGeneraleCategorie.map(function(item) {
    return parseInt(item.totalpoints);
  });
  console.log(labelsData);
  console.log(seriesData);
  // Configuration options for the pie chart
  var options = {
    series: seriesData,
    chart: {
      type: 'pie',
      width: 425,
      height: 425,
    },
    labels: labelsData,
  };
  
  
  // Initialize the pie chart
  var chart = new ApexCharts(document.querySelector("#pieChart2"), options);
  chart.render();
</script>
</html>
@endsection