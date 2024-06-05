    @extends('parent')
    @section('main')
    <style>
        body {
        }

    .container {
            width: 1000px;
            height: 800px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            font-size: 50px;
            font-weight: bold;
            margin-top: 20px;
            /* margin-bottom: 30px; */
            text-align: center;
            color: #940116;
        }

    .points-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

    .points-container p {
            font-size: 18px;
            color: black;
            text-align: center;
        }

        /* Nouvelle classe pour centrer le bouton */
    .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 50px;
        }
    
    </style>

    <!--  Header End -->
    
    <div class="container" id="content" style="background-image: url('../assets/images/backgrounds/certificate03.png');"> 
        
        <div>
            <div class="logo-container">
                <img src="../assets/images/logos/logo.png" width="160" alt="" style="
                padding-top: 60px;
                margin-left: 80px;" /> 
            </div>
            <h2>Equipe {{ $classementGenerale[0]->nomequipe }}</h2>
            <div class="points-container">
                <p>Total Points : {{ $classementGenerale[0]->totalpoints }} points</p>
                <p>Membres :
                    @foreach ($coureurs as $coureur )
                        {{$coureur->nomcoureur}}{{ $loop->last? '' : ',' }}
                    @endforeach
                </p>
                <p>Pénalités :
                    @foreach ($penalites as $penalite )
                        {{$penalite->tempspenalite}}{{ $loop->last? '' : ',' }}
                    @endforeach
                </p>
            </div>
        </div>
    </div>   

    <!-- Conteneur pour le bouton centré -->
    <div class="button-container">
        <button id="export-pdf" class="btn btn-primary">Exporter en PDF</button>
    </div> 

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    {{-- 
    <script src="../assets/libs/jquery/dist/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/libs/html2pdf.js-master/dist/html2pdf.bundle.min.js"></script> --}}

    <script>
    $(document).ready(function() {
        $('#export-pdf').click(function() {
            var element = document.getElementById('content');
            var button = document.getElementById('export-pdf');
            button.style.display = 'none';  

            var contentHeight = element.clientHeight; 
            var contentWidth = element.clientWidth; 
            console.log(contentHeight);
            console.log(contentWidth);
            html2pdf(element, {
                filename: 'Certificat.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { 
                    unit: 'pt',
                    format: [800, 600],
                    orientation: 'landscape'
                }
            }).then(() => {
                button.style.display = 'block';
            });
        });
    });

    </script>
    @endsection
