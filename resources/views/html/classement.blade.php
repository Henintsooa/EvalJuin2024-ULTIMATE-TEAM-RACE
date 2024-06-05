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
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100"> 
                  <div class="card-body p-4">
                      <h5 class="card-title fw-semibold mb-4">Classement général et points par étape</h5>
                      <div class="table-responsive">
                              <table class="table text-nowrap mb-0 align-middle">
                                  <thead class="text-dark fs-4">
                                      <tr>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Etape</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Classement</h6>
                                          </th>
                                        
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Equipe</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Points</h6>
                                          </th>
                                          
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php $currentEtape = null; @endphp
                                      @foreach ($classementGeneraleEquipes as $classementGeneraleEquipe)
                                      <tr>
                                        <td class="">
                                          @if ($classementGeneraleEquipe->nometape !== $currentEtape)
                                              <p class="mb-0 fw-normal">{{ $classementGeneraleEquipe->rangetape }}-{{ $classementGeneraleEquipe->nometape }}</p>
                                              @php $currentEtape = $classementGeneraleEquipe->nometape; @endphp
                                          @else
                                              <p class="mb-0 fw-normal"></p> <!-- Case vide pour ne pas répéter le nom de l'étape -->
                                          @endif
                                        </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEquipe->classementetape }}</p>
                                          </td>
                                          
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEquipe->nomequipe }}</p>
                                          </td>
                                          <td class="">
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
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Etape</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Classement</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Coureur</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Equipe</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Points</h6>
                                          </th>
                                          <th class="">
                                              <h6 class="fw-semibold mb-0">Durée</h6>
                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php $currentEtape = null; @endphp
                                      @foreach ($classementGeneraleEtapes as $classementGeneraleEtape)
                                      <tr>
                                        <td class="">
                                          @if ($classementGeneraleEtape->nometape !== $currentEtape)
                                              <p class="mb-0 fw-normal">{{ $classementGeneraleEtape->rangetape }}-{{ $classementGeneraleEtape->nometape }}</p>
                                              @php $currentEtape = $classementGeneraleEtape->nometape; @endphp
                                          @else
                                              <p class="mb-0 fw-normal"></p> <!-- Case vide pour ne pas répéter le nom de l'étape -->
                                          @endif
                                        </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->classement }}</p>
                                          </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomcoureur }}</p>
                                          </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->nomequipe }}</p>
                                          </td>
                                          <td class="">
                                              <p class="mb-0 fw-normal"> {{ $classementGeneraleEtape->points }} </p>
                                          </td>
                                          <td class="">
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

</html>
@endsection