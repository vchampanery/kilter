<!DOCTYPE HTML>
<html>
  <head>
    <title>SACC-2023 - Certificate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">
    
    <style type="text/css">
      /* Basic styling for root. */
       
    </style>
    <style>
      body {      
        margin:0px; padding: 0px;      
        font-family: 'Arial', sans-serif;cer
      }
   #main-certificate { position: relative;}
   .name { position: absolute;
      top: 360px;
      width: 100%;
      font-size: 50px;
      font-family: 'Dancing Script', cursive;


          left: 0px;
      text-align: center;
      font-weight: 600;}
    .score{
      position: absolute;
    top: 420px;
    width: 100%;
    font-size: 30px;
    left: 0px;
    text-align: center;
    font-weight: 800;

    }

    </style>
  </head>
  </head>

  <body>
    <!-- Button to generate PDF. -->
    

    <!-- Div to capture. -->
    <button onclick="getCertificate()">Generate PDF</button>
    <div id="main-certificate"  style=" width: 100%;height: 100%;">
          <img src="{{asset('assets/certi/certificate_new_1.png')}}" style=" width: 100%; height: 572pt;  "/>
          <span class="name">{{ucfirst(isset($data['name'])?$data['name']:'')}} </span>          
          <span class="score"> ({{number_format($data['total']/1000,2)}} Kms)</span>           
       </div>
 
    

    <!-- Include html2pdf bundle. -->
    <script src="{{asset('assets/certi/html2pdf.bundle.js')}}"></script>

    <script>
      function getCertificate() {
        // Get the element.
        var element = document.getElementById('main-certificate');
        // Generate the PDF.
        html2pdf().from(element).set({          
          margin:10,
          filename: '{{ucfirst(isset($data['name'])?$data['name']:'')}}'+'.pdf',
          image: { type: 'jpeg', quality: 1 },
          html2canvas: { scale: 1 },
          jsPDF: {orientation: 'landscape', unit: 'pt', format: 'a4', compressPDF: true}
        }).save();
      }

 


    </script>
  </body>
</html>
