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
                        <a href="{{route('affecterTemps', ['idEtape' => $etape->idetape]) }}" class="btn btn-primary btn-sm">Affecter temps coureur</a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="col-lg-8 d-flex align-items-stretch">
          @if(session()->has('success'))
          <div class="alert alert-success" role="alert">
              {{ session()->get('success') }}
          </div>
          @endif
  
          @if($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
      </div> --}}
      {{-- <div class="col-lg-8 d-flex align-items-stretch">
          <div class="card w-100">
              <div class="card-body p-6">
                  <h5 class="card-title fw-semibold mb-4">Affecter temps</h5>
                  <div class="table-responsive">
                    <form method="POST" action="/affecterTemps">
                      @csrf
                      <div class="mb-3">
                          <label for="etape" class="form-label">Etape</label>
                          <select class="form-select" name="idEtape" id="idEtape">
                              <option value="">Selectionner une etape</option>
                              @foreach ($etapes as $etape)
                              <option value="{{ $etape->idetape }}" {{ old('idEtape') == $etape->idetape ? 'selected' : '' }}>{{ $etape->rang }}-{{ $etape->nometape }}</option>
                              @endforeach
                          </select>
                          @error('idEtape')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label for="coureur" class="form-label">Coureur</label>
                          <select class="form-select" name="idCoureur" id="idCoureur">
                              <option value="">Selectionner un coureur</option>
                              
                          </select>
                          @error('idCoureur')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>                   
                      <div class="mb-3">
                          <label for="heureDepart" class="form-label">Heure Depart</label>
                          <input type="time" step="1" class="form-control" name="heureDepart" value="{{ old('heureDepart') }}">
                          @error('heureDepart')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label for="heureArrivee" class="form-label">Heure Arrivée</label>
                          <input type="time" step="1" class="form-control" name="heureArrivee" value="{{ old('heureArrivee') }}">
                          @error('heureArrivee')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>  --}}
                      {{-- <div class="mb-3">
                          <input class="form-check-input" type="radio" name="lendemain" value="1" {{ old('lendemain') == '1' ? 'checked' : '' }}>
                          <label class="form-check-label">Lendemain</label>
                      </div>   --}}
                      {{-- <button type="submit" class="btn btn-primary">Valider</button>
                    </form>

  
                  </div>
              </div>
          </div>
        </div> --}}
      </div>  
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                  <script>
                      $(document).ready(function() {
                          $('#idEtape').change(function() {
                              var idEtape = $(this).val();
                              if (idEtape) {
                                  $.ajax({
                                      url: '{{ route('getCoureursByEtape') }}',
                                      type: 'POST',
                                      data: {
                                          _token: '{{ csrf_token() }}',
                                          idEtape: idEtape
                                      },
                                      success: function(data) {
                                          var coureurSelect = $('#idCoureur');
                                          coureurSelect.empty();
                                          coureurSelect.append('<option value="">Selectionner un coureur</option>');
                                          $.each(data, function(key, value) {
                                              coureurSelect.append('<option value="'+ value.idcoureur +'">'+ value.nomcoureur +'</option>');
                                          });
                                      }
                                  });
                              } else {
                                  $('#idCoureur').empty().append('<option value="">Selectionner un coureur</option>');
                              }
                          });
                      });
                  </script>
</html>
@endsection