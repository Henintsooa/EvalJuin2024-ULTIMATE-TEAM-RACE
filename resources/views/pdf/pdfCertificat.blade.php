<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/logo.png" /> 
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    
    <title>Pdf</title>
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
</head>
<body>
    <!--  Header End -->
    
    <div class="container" id="content" style="background-image: url('../../assets/images/backgrounds/certificate03.png');"> 
        
        <div>
            <div class="logo-container">
                <img src="../../assets/images/logos/logo.png" width="160" alt="" style="
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
            </div>
        </div>
    </div>   
</body>
</html>
