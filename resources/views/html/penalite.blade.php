@extends('parent')
@section('main')
      <!--  Header End -->
      <div class="container-fluid"> 
        
        <!--  Row 1 -->
        
          <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
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
            </div>
            <div class="col-lg-8 d-flex align-items-stretch">
              <div class="card w-100">
                  <div class="card-body p-6">
                      <h5 class="card-title fw-semibold mb-4">Ajout Pénalité</h5>
                        <div class="table-responsive">
                          <form method="POST" action="/insertPenalite">
                              @csrf
                                <div class="mb-3">

                                  <select class="form-select" name="idetape" id="idetape">
                                    <option value="">Selectionner une étape</option>
                                    @foreach ($etapes as $etape)
                                    <option value="{{ $etape->idetape }}" {{ old('idetape') == $etape->idetape ? 'selected' : '' }}>{{ $etape->nometape }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                
                                <div class="mb-3">
                                  <select class="form-select" name="idequipe" id="idequipe">
                                    <option value="">Selectionner une equipe</option>
                                    @foreach ($equipes as $equipe)
                                    <option value="{{ $equipe->idequipe }}" {{ old('idequipe') == $equipe->idequipe ? 'selected' : '' }}>{{ $equipe->nomequipe }}</option>
                                    @endforeach
                                  </select>    
                                </div>
                                <div class="mb-3">
                                  <label for="tempsPenalite" class="form-label">Pénalite</label>
                                  <input type="time" step="1" class="form-control"  name="tempsPenalite" id="">
                                </div>
                              <button type="submit" id="submitBtn" class="btn btn-primary">Valider</button>
                          </form>
                        </div>
                  </div>
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